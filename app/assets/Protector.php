<?php
/*
 * File: Protector.php
 * Category: Security
 * Author: MSG
 * Created: 23.09.14 11:07
 * Updated: -
 *
 * Description:
 *  Prevents users from having access to certain pages
 */

class Protector {

    private $router;

    public function __construct($router){
        $this->router = $router;
    }

    public function reveal(){

        $rule = Rule::find(array('conditions' => array('controller = ? AND method = ?', $this->router->getController(), $this->router->getMethod())));

        if($rule == null){
            $this->router->setController('home');
            $this->router->setMethod('error_404');
        }else{
            $right = Right::find(array('conditions' => array('rule_id = ? AND (user_id = ? OR group_id = ?)', $rule->id, ($this->router->core->getUser()!=null?$this->router->core->getUser()->id:null), ($this->router->core->getUser()!=null?$this->router->core->getUser()->group_id:null))));

            if($right == null){

                $final = Right::find(array('conditions' => array('rule_id = ? AND user_id IS NULL AND group_id IS NULL', $rule->id)));

                if($final == null){
                    $this->router->setController('home');
                    $this->router->setMethod('error_401');
                }
            }
        }

    }

}