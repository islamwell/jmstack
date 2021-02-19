<?php
/**
 * EMHelper 
 * 
 * @version 1.0
 * @author vi mark <webvimark@gmail.com> 
 * @license MIT
 */
class EMHelper
{
        //=========== CHtml helpers ===========

        /**
         * megaOgogo 
         *
         * User if you have Twitter Boostrap.
         * Makes tab switcher bewtween languages for inputs
         * 
         * @param CActiveRecord $model 
         * @param string $attribute 
         * @param array $htmlOptions 
         * @param string $fieldType - "textField" or "textArea" 
         *
         * @return html
         */
        public static function megaOgogo($model, $attribute, $htmlOptions = array(), $fieldType = 'textField')
        {
                $fieldType = 'active'.ucfirst($fieldType);

                $languages = $model->languages;

                if ( (count($languages) > 1) AND in_array($attribute, $model->translated_attributes))
                {
                        $sid = uniqid();

                        $output = "";
                        $output .= "<ul class='nav nav-tabs easy-multilanguage-tabs' style='margin-bottom:0px; border-bottom:none;'>";
                        foreach ($languages as $lang => $langName) 
                        {
                                $isActive = ($model->default_language == $lang) ? 'active' : '';

                                $output .= "<li class='{$isActive}'><a href='#".$sid.$lang."' data-toggle='tab'>{$langName}</a></li>";
                        }
                        $output .= "</ul>";

                        $output .= "<div class='tab-content'>";
                        foreach ($languages as $lang => $langName) 
                        {
                                if ($lang == $model->default_language) 
                                        $output .= "<div class='tab-pane active' id='".$sid.$lang."'>".CHtml::$fieldType($model, $attribute, $htmlOptions)."</div>";
                                else
                                        $output .= "<div class='tab-pane' id='".$sid.$lang."'>".CHtml::$fieldType($model, $attribute.'_'.$lang, $htmlOptions)."</div>";
                        }
                        $output .= "</div>";

                        return $output;
                }
                else
                        return CHtml::$fieldType($model, $attribute, $htmlOptions);
        }

        /**
         * multiInput 
         *
         * If you don't have Twitter Boostrap, then use this helper
         * Makes tab switcher bewtween languages for inputs
         * 
         * @param CActiveRecord $model 
         * @param string $attribute 
         * @param array $htmlOptions 
         * @param string $fieldType - "textField" or "textArea" 
         *
         * @return html
         */
        public static function multiInput($model, $attribute, $htmlOptions = array(), $fieldType = 'textField')
        {
                self::registerScriptAndCssForTabs();

                $fieldType = 'active'.ucfirst($fieldType);

                $languages = $model->languages;

                if ( (count($languages) > 1) AND in_array($attribute, $model->translated_attributes))
                {
                        $sid = uniqid();

                        $output = "";
                        $output .= "<ul class='em-tab-header'>";
                        foreach ($languages as $lang => $langName)
                        {
                                $isActive = ($model->default_language == $lang) ? 'em-active' : '';

                                $output .= "<li em-target='".$sid.$lang."' class='{$isActive}'>{$langName}</li>";
                        }
                        $output .= "</ul>";

                        $output .= "<div class='em-tab-content'>";
                        foreach ($languages as $lang => $langName)
                        {
                                if ($lang == $model->default_language)
                                        $output .= "<div class='em-tab-pane em-active' id='".$sid.$lang."'>".CHtml::$fieldType($model, $attribute, $htmlOptions)."</div>";
                                else
                                        $output .= "<div class='em-tab-pane' id='".$sid.$lang."'>".CHtml::$fieldType($model, $attribute.'_'.$lang, $htmlOptions)."</div>";
                        }
                        $output .= "</div>";

                        return $output;
                }
                else
                        return CHtml::$fieldType($model, $attribute, $htmlOptions);
        }

        /**
         * registerScriptAndCssForTabs 
         *
         * Used in self::multiInput(...);
         * 
         * @return void
         */
        public static function registerScriptAndCssForTabs()
        {
                $tabsCssFile = CHtml::asset(__DIR__.'/assets/tabs.css');
                Yii::app()->clientScript->registerCssFile($tabsCssFile);

                Yii::app()->clientScript->registerScript('em-tabs',"
                        $(document).on('click', '.em-tab-header > li', function(){

                                $('#' + $(this).attr('em-target')).parent().find('.em-active').removeClass('em-active');
                                $('#' + $(this).attr('em-target')).addClass('em-active');

                                $(this).parent().find('li.em-active').removeClass('em-active');
                                $(this).addClass('em-active');
                        });
                ");
        }

        //----------- CHtml helpers -----------



        //=========== Some other stuff ===========

        /**
         * WinnieThePooh 
         *
         * Wiinie helps to find out if "$name" is in our translated attributes
         *
         * Winnie lives in model setters
         * 
         * @param string $name 
         * @param array $behaviors 
         * @return boolean
         */
        public static function WinnieThePooh($name, $behaviors)
        {
                $emBehavior = $behaviors['EasyMultiLanguage'];

                // Remove default language. 
                // We don't need "name_ru" if Russian is our default language
                unset($emBehavior['languages'][$emBehavior['default_language']]);
                $languages = array_keys($emBehavior['languages']);

                foreach ($languages as $lang) 
                {
                        if ( in_array( basename($name, '_'.$lang), $emBehavior['translated_attributes'] ) ) 
                        {
                                return true;
                        }
                }

                return false;
        }

        /**
         * catchLanguage 
         *
         * Changing language depending on the $_GET['_language'] parameter
         *
         * Used in base Controller in init() function
         *
         * @stolen from http://www.yiiframework.com/wiki/294/seo-conform-multilingual-urls-language-selector-widget-i18n/ 
         */
        public static function catchLanguage()
        {
                if(isset($_POST['_language_selector'])) 
                {
                        $lang = $_POST['_language_selector'];
                        $MultilangReturnUrl = $_POST[$lang];
                        Yii::app()->controller->redirect($MultilangReturnUrl);
                }

                if(isset($_GET['_language'])) 
                {
                        Yii::app()->language = $_GET['_language'];
                        Yii::app()->user->setState('_language', $_GET['_language']); 

                        $cookie = new CHttpCookie('_language', $_GET['_language']);
                        $cookie->expire = time() + (3600*24*7); // 7 days
                        Yii::app()->request->cookies['_language'] = $cookie; 
                }
                elseif (Yii::app()->user->hasState('_language'))
                {
                        Yii::app()->language = Yii::app()->user->getState('_language');
                }


        }


        /**
         * createMultilanguageReturnUrl 
         * 
         * @param string $lang 
         * @return string
         *
         * @stolen from http://www.yiiframework.com/wiki/294/seo-conform-multilingual-urls-language-selector-widget-i18n/ 
         */
        public static function createMultilanguageReturnUrl($lang)
        {
                if (count($_GET) > 0)
                {
                        $arr = $_GET;
                        $arr['_language']= $lang;
                }
                else 
                        $arr = array('_language'=>$lang);

                return Yii::app()->controller->createUrl('', $arr);
        }
}
