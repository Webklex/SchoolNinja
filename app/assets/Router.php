<?php
/*
 * File: Router.php
 * Category: System
 * Author: MSG
 * Created: 19.09.14 15:38
 * Updated: -
 *
 * Description:
 *  The router manages all or better most of the dependencies
 *  and knows where the most important stuff is being located.
 */

class Router{

    private $request;
    public $core;
    private $app;
    private $response;
    private $templater;

    private $protector;

    private $controller;
    private $method;

    public function __construct(){
        $this->buildCore();
        $this->loadRequests();

        $this->controller = $this->request['get']['c'];
        $this->method = $this->request['get']['m'];

        $this->loadProtector();
        $this->protector->reveal();

        $this->loadTemplater();
        $this->route();
    }

    public function setController($controller){
        $this->controller = $controller;
    }

    public function setMethod($method){
        $this->method = $method;
    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function redirect($options){
        header('Location: '.PAGE_ROOT.$options['controller'].'/'.$options['method'].'/');
    }

    private function route(){

        if(!empty($this->controller) && !empty($this->method)){
            try{
                $controller = $this->controller.'Controller';

                $this->app = new $controller();

                if(method_exists($this->app, $this->method) == false){
                    $this->controller = 'home';
                    $this->method = 'error_404';
                    $controller = $this->controller.'Controller';

                    $this->app = new $controller();
                }

                $this->app->setData($this->request);
                $this->app->setRouter($this);
                $this->app->setUser($this->core->user);
                $this->response = $this->app->{$this->method}();

                $this->templater->setApp($this->app);

                $this->templater->render($this->controller, $this->method);
            }catch(Exception $e){
                $this->redirect(array('controller' => 'home', 'method' => 'error_404'));
            }
        }

    }

    private function loadProtector(){
        $this->protector = new Protector($this);
    }

    private function loadTemplater(){
        $this->templater = new Templater();
    }

    private function buildCore(){
        require_once __DIR__.'/../core/coreController.php';
        $this->core = new coreController();
    }

    private function loadRequests(){

        $_GET['c'] = (!empty($_GET['c'])?$_GET['c']:'home');
        $_GET['m'] = (!empty($_GET['m'])?$_GET['m']:'index');

        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
    }
}