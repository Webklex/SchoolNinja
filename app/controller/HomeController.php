<?php
/*
 * File: homeController.php
 * Category: -
 * Author: MSG
 * Created: 23.09.14 10:30
 * Updated: -
 *
 * Description:
 *  -
 */

class HomeController extends AppController {

    public function index(){
        return array('content' => 'data');
    }

    public function error_404(){}
    public function error_401(){}
}