<?php
/**
 * EMSingleton 
 * 
 * @version 1.0
 * @author vi mark <webvimark@gmail.com> 
 * @license MIT
 */
class EMSingleton
{
        private static $_instance;

        public $dataArray = array();

        private function __construct() {}
        private function __clone() {}

        /**
         * getInstance 
         * 
         * @return self
         */
        public static function getInstance()
        {
                if (null === self::$_instance)
                        self::$_instance = new self();

                return self::$_instance;
        }

        /**
         * setData 
         * 
         * @param string $to 
         * @param mixed $data 
         */
        public function setData($to, $data)
        {
                $this->dataArray[$to] = $data;
        }

        /**
         * getData 
         * 
         * @param string $from 
         * @return mixed
         */
        public function getData($from)
        {
                return isset($this->dataArray[$from]) ? $this->dataArray[$from] : null;
        }
}
