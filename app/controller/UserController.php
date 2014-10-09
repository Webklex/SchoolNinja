<?php
/*
 * File: userController.php
 * Category: -
 * Author: MSG
 * Created: 24.09.14 09:36
 * Updated: -
 *
 * Description:
 *  -
 */

class UserController extends AppController {

    public function login(){

        if(isset($this->data['post']['login'])){
            $user = User::find(array('conditions' => array('email = ? AND passwd = ?', $this->data['post']['email'], Helper::generatePasswd($this->data['post']['passwd']))));

            if($user == null){
                $this->setFlasher(array(
                    'type'      => 'danger',
                    'title'     => 'Ein Fehler ist aufgetreten',
                    'content'   => 'Hmmm... mit deinen Angaben konnten wir leider nichts anfangen. Bitte versuche es erneut mit den richtigen Daten.'
                ));
            }else{
                $_SESSION['user_id'] = $user->id;
                $_SESSION['group_id'] = $user->group_id;

                $this->setUser($user);

                $this->router->redirect(array('controller' => 'home', 'method' => 'dashboard'));
            }
        }
    }

    public function register(){
        if(isset($this->data['post']['register'])){
            try{
                $user = User::create(array(
                    'group_id'  => 3,
                    'name'      => $this->data['post']['name'],
                    'email'     => $this->data['post']['email'],
                    'passwd'    => Helper::generatePasswd($this->data['post']['passwd']),
                    'salt'      => Helper::generatePasswd($this->data['post']['passwd'], true)
                ));

                if(count($user->errors->get_raw_errors()) > 0){
                    $this->setFlasher(array(
                        'type'      => 'danger',
                        'title'     => 'Ein Fehler ist aufgetreten',
                        'content'   => 'Hmmm... mit deinen Angaben konnten wir leider nichts anfangen. Bitte versuche es erneut mit anderen Daten, denn deine Emailadresse oder Name sind bereits vergeben.'
                    ));
                }else{
                    $this->router->redirect(array('controller' => 'user', 'method' => 'welcome'));
                }
            }catch(Exception $e){
                $this->setFlasher(array(
                    'type'      => 'danger',
                    'title'     => 'Ein Fehler ist aufgetreten',
                    'content'   => 'Hmmm... mit deinen Angaben konnten wir leider nichts anfangen. Bitte versuche es erneut mit den richtigen Daten.'
                ));
            }
        }
    }

    public function edit(){
        if(isset($this->data['post']['edit'])){
            $user = User::find_by_id($this->user->id);

            if($user !== null){
                if(!empty($this->data['post']['name'])){
                    $user->passwd = Helper::generatePasswd($this->data['post']['passwd']);
                    $user->salt = Helper::generatePasswd($this->data['post']['passwd'], true);
                }
                $user->name = $this->data['post']['name'];
                $user->email = $this->data['post']['email'];

                if(!$user->save()){
                    $this->setFlasher(array(
                        'type'      => 'danger',
                        'title'     => 'Ein Fehler ist aufgetreten',
                        'content'   => 'Hmmm... mit deinen Angaben konnten wir leider nichts anfangen. Bitte versuche es erneut mit den richtigen Daten.'
                    ));
                }else{
                    $this->setFlasher(array(
                        'type'      => 'success',
                        'title'     => 'Einfach wunderbar!',
                        'content'   => 'Deine Daten konnten wir einfach so speichern, hervorragend gemacht!'
                    ));
                }
            }
        }
    }

    public function logout(){
        session_destroy();
        $this->router->redirect(array('controller' => 'user', 'method' => 'goodbye'));
    }

    public function profile(){}

    public function welcome(){}
    public function goodbye(){}

}