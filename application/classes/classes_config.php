<?php

class classes_config  {
  
      private $config ;
      
      static private $instance = null;
  
      static public function getInstance() {
         if (null === self::$instance) {
             self::$instance = new self;
         }
         return self::$instance;
     }
     
     private function __construct(){         
         require_once 'application/config/app_config.php';
     }
          
     private function __clone(){}

     public function getConfigArray(){
         return $this->config ;
     }
     
}



?>
