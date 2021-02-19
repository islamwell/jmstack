<?php
/**
 * EasyMultiLanguageBehavior 
 * 
 * @version 1.0
 * @author vi mark <webvimark@gmail.com> 
 * @license MIT
 */
class EasyMultiLanguageBehavior extends CActiveRecordBehavior
{
        /**
         * translated_attributes 
         * 
         * Atrtibutes, which will be translate.  ('name', 'description', 'title')
         * E.g created virtual attribtues like description_en, description_ru etc.
         *
         * @var array
         */
        public $translated_attributes = array();

        /**
         * languages 
         *
         * Which languages do you want (
         *      'ru' => 'Русский', 
         *      'en' => 'English',
         *      'de' => 'Deutsche',
         * )
         * For example - public $languages = Yii::app()->params['languages'];
         * 
         * @var array
         */
        public $languages = array();

        /**
         * default_language 
         * 
         * @var string
         */
        public $default_language = 'en';
        //public $default_language = 'ru';

        /**
         * translations_table 
         *
         * Where we store translations for this model
         * You can use different tables for different models.
         *
         * Lets say, you have "News" model, where you use "mediumtext" to store data
         * And have a "User" model, where you use "varchar" and more often then "News", so to not
         * load one big translations table, you can specify different tables for them
         * 
         * @var string
         */
        public $translations_table = 'translations';

        /**
         * admin_routes 
         *
         * By default, this thing overwrite main value with its foreign friend if language changed.
         *
         * <example>
         *      Let's say you have default language "ru". And you have this book:
         *              $book->name = "Снег";
         *              $book->name_en = "Snow";
         *
         *      Now if you'll change language to "en", You book will looks like this:
         *              $book->name = "Snow";
         *              $book->name_en = "Snow";
         * </example>
         * 
         * But if you want to edit all languages without constant language swapping,
         * then show routes, where main value will remain.
         *
         * <example>
         *      public $admin_routes = array('book/update', 'book/create', 'book/admin');
         * </example>
         * 
         * @var array
         */
        public $admin_routes = array();



        /**
         * attach 
         *
         * Initialize virtual attributes. Like "name_en", "name_ru", etc.
         *
         * Create validation rules for "name_en", "name_ru", etc. if they are not set.
         * So this attributs can be mass assigned to model attributes via post
         */
        public function attach($owner)
        {
                // Remove default language from translated
                $tmp = $this->languages;
                unset($tmp[$this->default_language]);

                $languages = array_keys($tmp);

                $validate = array();
                $no_validate = array();

                foreach ($languages as $lang) 
                {
                        foreach ($this->translated_attributes as $attribute) 
                        {
                                $attr = $attribute.'_'.$lang;

                                // Initialize this attributes
                                $owner->{$attr} = '';

                                // Creating array of all attributes with lang postfix (attribute_lang)
                                if (! in_array($attr, $validate))
                                        $validate[] = $attr;

                                foreach ($owner->rules() as $rule) 
                                {
                                        if (in_array($attr, array_map('trim', explode(',', $rule[0])))) 
                                        {
                                                // Creating array of all attributes with lang postfix (attribute_lang)
                                                // that already have validation rules
                                                if (! in_array($attr, $no_validate))
                                                        $no_validate[] = $attr;
                                        }
                                }
                        }
                }

                $to_validate = array_diff($validate, $no_validate);

                foreach ($to_validate as $attr) 
                        $owner->getValidatorList()->add(CValidator::createValidator('safe', $owner, $attr));

                parent::attach($owner);
        }

        /**
         * afterSave 
         *
         * Save transalted values in translations table
         */
        public function afterSave($event)
        {
                // Remove default language from translated
                $tmp = $this->languages;
                unset($tmp[$this->default_language]);

                $languages = array_keys($tmp);

                foreach ($this->translated_attributes as $attr) 
                {
                        foreach ($languages as $lang) 
                        {
                                $value = $this->owner->{$attr.'_'.$lang};

                                $isMulitlangTableExists = Yii::app()->db->createCommand()
                                        ->select('id')
                                        ->from($this->translations_table)
                                        ->where("
                                                table_name = '{$this->owner->tableName()}' AND 
                                                model_id = '{$this->owner->id}' AND 
                                                attribute = '{$attr}' AND 
                                                lang = '{$lang}'
                                        ")->queryRow();

                                if ($this->owner->isNewRecord OR ($isMulitlangTableExists === false) )
                                {
                                        Yii::app()->db->createCommand()->
                                                insert($this->translations_table, array(
                                                        'table_name' => $this->owner->tableName(),
                                                        'attribute'  => $attr,
                                                        'lang'       => $lang,
                                                        'model_id'   => $this->owner->id,
                                                        'value'      => $value,
                                                ));
                                }
                                else 
                                {

                                        Yii::app()->db->createCommand()->
                                                update($this->translations_table, 
                                                        array(
                                                                'value' => $value,
                                                        ), 
                                                        '(table_name = :table_name) AND (attribute = :attribute) AND '.
                                                        '(lang = :lang) AND (model_id = :model_id)',
                                                        array(
                                                                'table_name' => $this->owner->tableName(),
                                                                'attribute'  => $attr,
                                                                'lang'       => $lang,
                                                                'model_id'   => $this->owner->id,
                                                        )
                                                );
                                }
                        }
                }
        }

        /**
         * afterDelete 
         * 
         * Delete values from translations table
         */
        public function afterDelete($event)
        {
                Yii::app()->db->createCommand()
                        ->delete($this->translations_table, '(table_name = :table_name) AND (model_id = :model_id)', array(
                                'table_name' => $this->owner->tableName(),
                                'model_id'   => $this->owner->id,
                        ));
        }

        /**
         * afterFind 
         *
         * Fill virtual attributes with translation values.
         * Overwrite main attribute with current language value if it's not admin route
         */
        public function afterFind($event)
        {
                // Remove default language from translated
                $tmp = $this->languages;
                unset($tmp[$this->default_language]);

                $languages = array_keys($tmp);

                // preserve values
                $values = EMSingleton::getInstance()->getData('alreadyFound_'.$this->owner->tableName());

                foreach ($this->translated_attributes as $attr) 
                        $attributes[] = "'{$attr}'";

                // If it's admin routes, we load all data
                if ( in_array( strtolower(Yii::app()->controller->route), array_map('strtolower', $this->admin_routes) ) ) 
                {
                        if (! $values) 
                        {
                                $values = Yii::app()->db->createCommand()
                                        ->select('value, lang, model_id, attribute')
                                        ->from($this->translations_table)
                                        ->where("
                                                table_name = '{$this->owner->tableName()}' AND 
                                                attribute IN (".implode(',', $attributes).")
                                        ")->queryAll();

                                // Preserve values, to prevent multiple queries
                                EMSingleton::getInstance()->setData('alreadyFound_'.$this->owner->tableName(), $values);
                        }

                        foreach ($values as $val) 
                        {
                                $result[$val['model_id']][$val['attribute']][$val['lang']] = $val['value'];
                        }


                        foreach ($this->translated_attributes as $attr) 
                        {
                                foreach ($languages as $lang) 
                                {
                                        if (isset($result[$this->owner->id][$attr][$lang]))
                                        {
                                                $this->owner->{$attr.'_'.$lang} = $result[$this->owner->id][$attr][$lang];
                                        }
                                }
                        }
                }
                // If current language is in aray of translated languages, then we load data for this model with this language
                // and overwrite primary attribute with current language value
                elseif (in_array(Yii::app()->language, $languages))
                {
                        if (! $values) 
                        {
                                $values = Yii::app()->db->createCommand()
                                        ->select('value, attribute, model_id')
                                        ->from($this->translations_table)
                                        ->where("
                                                table_name = '{$this->owner->tableName()}' AND 
                                                lang = '".Yii::app()->language."' AND 
                                                attribute IN (".implode(',', $attributes).")
                                        ")->queryAll();

                                // Preserve values, to prevent multiple queries
                                EMSingleton::getInstance()->setData('alreadyFound_'.$this->owner->tableName(), $values);
                        }

                        foreach ($values as $val) 
                        {
                                $result[$val['model_id']][$val['attribute']] = $val['value'];
                        }


                        foreach ($this->translated_attributes as $attr) 
                        {
                                if ( isset($result[$this->owner->id][$attr]) AND ! empty($result[$this->owner->id][$attr]) )
                                {
                                        $this->owner->{$attr} = $result[$this->owner->id][$attr];
                                }
                        }
                }

        }
}
