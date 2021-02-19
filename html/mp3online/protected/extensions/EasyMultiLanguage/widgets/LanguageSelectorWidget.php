<?php
/**
 * LanguageSelectorWidget 
 * 
 * @version 1.0
 * @author vi mark <webvimark@gmail.com> 
 * @license MIT
 *
 * @stolen from http://www.yiiframework.com/wiki/294/seo-conform-multilingual-urls-language-selector-widget-i18n/ 
 * @modified by me
 */
class LanguageSelectorWidget extends CWidget
{
        /**
         * style 
         *
         * "dropDown" or "inline"
         * 
         * @var string
         */
        public $style = 'dropDown';

        /**
         * cssClass 
         *
         * Additional css class for selector
         * 
         * @var string
         */
        public $cssClass = '';


        /**
         * init 
         */
        public function init()
        {
//                $languages = Yii::app()->params['languages'];

            $criteria=new CDbCriteria;
            $criteria->condition='active=:active';
            $criteria->params=array(':active'=>1);
            $language=Language::model()->findAll($criteria); // $params is not needed

            $languages= array('en'=>'English');
            foreach ($language as $item)
            {
                $code=$item->lang;
                $name=$item->name;
                $lang=array($code=>$name);
                $languages= array_merge($languages,$lang);
            }


                if (count($languages) > 1)
                {
                        $this->render($this->style, array(
                                'languages' => $languages,
                                'cssClass'  => $this->cssClass,
                        ));
                }
        }
}
