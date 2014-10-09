<?php
/*
 * File: appController.php
 * Category: -
 * Author: MSG
 * Created: 23.09.14 10:06
 * Updated: -
 *
 * Description:
 *  -
 */

class appController extends coreController {

    private $flasher = false;
    protected $router;

    public function __construct(){}

    public function index(){}

    public function setUser($user){
        $this->user = $user;
    }

    public function setFlasher($data){
        $this->flasher[] = $data;
    }

    public function getFlasher(){
        return $this->flasher;
    }

    public function setRouter($router){
        $this->router = $router;
    }
}