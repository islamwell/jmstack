<?php
/**
 * EMUrlManager 
 *
 * Used for multilingual applications
 * 
 * @version 1.0
 * @author vi mark <webvimark@gmail.com> 
 * @license MIT
 */
class EMUrlManager extends CUrlManager
{
        /**
         * init 
         *
         * Adding language prefixes to url rules
         */
        public function init()
        {
                $languages = array_keys(Yii::app()->params['languages']);

                if (count($languages) > 1) 
                {
                        $langPrefix = '<_language:('.implode('|', $languages).')>/';

                        $finalRurles[$langPrefix] = '/';

                        foreach ($this->rules as $rule => $path) 
                        {
                                $finalRurles[$langPrefix . ltrim($rule, '/')] = $path;
                        }

                        $this->rules = array_merge($finalRurles, $this->rules);
                }

                parent::init();
        }

        /**
         * createUrl 
         *
         * Adding language parameter to links
         * 
         * @param string $route 
         * @param array $params 
         * @param string $ampersand 
         *
         * @stolen from http://www.yiiframework.com/wiki/294/seo-conform-multilingual-urls-language-selector-widget-i18n/ 
         */
        public function createUrl($route,$params=array(),$ampersand='&')
        {
                if (!isset($params['_language']))
                {
                        if (Yii::app()->user->hasState('_language'))
                        {
                                Yii::app()->language = Yii::app()->user->getState('_language');
                        }
                        elseif (isset(Yii::app()->request->cookies['_language']))
                        {
                                Yii::app()->language = Yii::app()->request->cookies['_language']->value;
                        }

                        $params['_language'] = Yii::app()->language;
                }

                return parent::createUrl($route, $params, $ampersand);
        }
}
