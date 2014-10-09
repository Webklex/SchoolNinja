<?php
/*
 * File: Templater.php
 * Category: Design, System
 * Author: MSG
 * Created: 23.09.14 09:32
 * Updated: -
 *
 * Description:
 *  Der Templater verarbeitet alle design spezifischen Anfragen
 */

class Templater{

    private $theme = DEFAULT_TEMPLATE;

    private $app = null;

    public function __construct(){

    }

    public function render($controller, $method){
        $this->loadHeader();
        $this->loadFlasher();
        $this->loadView($controller, $method);
        $this->loadFooter();
    }

    private function loadFlasher(){
        require_once ROOT_PATH.'/app/views/'.$this->theme.'/template/flasher.php';
    }

    private function loadView($controller, $method){
        require_once ROOT_PATH.'/app/views/'.$this->theme.'/'.$controller.'/'.$method.'.stp';
    }

    private function loadHeader(){
        require_once ROOT_PATH.'/app/views/'.$this->theme.'/template/header.php';
    }

    private function loadFooter(){
        require_once ROOT_PATH.'/app/views/'.$this->theme.'/template/footer.php';
    }

    public function setApp($app){
        $this->app = $app;
    }

    public function setTheme($theme){
        $this->theme = $theme;
    }


}