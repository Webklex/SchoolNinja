<?php
class coreController {

    protected $configs = array('database','common');
    public $data = null;

    public $user;
    protected $session;

    public function __construct(){
        $this->loadConfig();
        $this->initAutoload();
        $this->initActiveRecord();
        $this->loadDynamicConfig();
        $this->initSession();
        $this->loadUser();
    }

    public function setData($data){
        $this->data = $data;
    }

    public function initSession(){
        session_start();
        $this->loadSession();
    }

    private function loadUser(){
        $this->user = User::find((isset($this->session['user_id'])?$this->session['user_id']:null));
    }

    private function loadSession(){
        $this->session = $_SESSION;
    }

    public function getUser(){
        return $this->user;
    }

    protected function initAutoload(){
        spl_autoload_register(function ($class) {

            if($class !== 'Controller'){
                $folders = array('controller','assets', 'libs', 'core');

                foreach($folders as $folder){

                    $file = ROOT_PATH.'/app/'.$folder.'/'.$class.'.php';

                    if(file_exists($file)){
                        require_once ROOT_PATH.'/app/'.$folder.'/'.$class.'.php';
                        return true;
                    }
                }
                throw new Exception('Class can\'t be loaded in '.$file.' '.__LINE__);
            }
        });
    }

    private function loadDynamicConfig(){
        try{
            $configs = Config::all();

            foreach($configs as $config){
                if(!defined($config->name)){
                    define($config->name, $config->value);
                }
            }
        }catch(Exception $e){
            throw new Exception('Dynamisches laden der Konfigurierung ist fehlgeschlagen');
        }
    }

    private function loadConfig(){
        foreach($this->configs as $config){
            try{
                require_once __DIR__.'/../config/'.$config.'.php';
            }catch(Exception $e){
                throw new Exception('Configuration <b>"'.$config.'" couldn\'t be found</b>');
            }
        }
    }

    protected function initActiveRecord(){
        try{
            require_once __DIR__.'/../libs/ActiveRecord/ActiveRecord.php';
            $connections = array(
                'development' => 'mysql://'.DATABASE_USER.'@'.DATABASE_HOST.'/'.DATABASE_NAME.'?charset=utf8',
                'production' => 'mysql://'.DATABASE_USER.'@'.DATABASE_HOST.'/'.DATABASE_NAME.'?charset=utf8'
            );
            ActiveRecord\Config::initialize(function($cfg) use ($connections)
            {
                $cfg->set_model_directory(ROOT_PATH.'/app/models');
                $cfg->set_connections($connections);
                $cfg->set_default_connection('development');
            });
        }catch(Exception $e){
            throw new Exception('Database is somewhere else - but definitely not here!');
        }

    }
}