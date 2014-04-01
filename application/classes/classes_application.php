<?php
class classes_application {
	public $__DB;
	public $__SESSION;
	
	public function __construct(){}
	
	private function init(){
		/*
		 * Init class autoloader
		 */
		$this->autoload();
		/*
		 * Get config
		 */
		classes_config::getInstance();
		
		/*
		 * Connect to database
		 */
		$this->__DB = new classes_DB();
		 
		/*
		 * Init session
		 */ 
		 $this->__SESSION = new classes_session();
	}
	
	private function autoload(){
		function __autoload($className) {
			if($className != 'self' && $className != 'parent'){
				
        	//class directories
        	$directorys = array(
            	'classes/',
            	'classes/otherclasses/',
            	'classes2/',
            	'module1/classes/',
            	'',
            	'../application/classes/'
        	);
        
        	//for each directory
        	foreach($directorys as $directory){
            	//see if the file exsists
            	if(file_exists($directory.$className . '.php')){
                	require_once($directory.$className . '.php');
                	//only require the class once, so quit after to save effort (if you got more, then name them something else 
                	return true;
            	}            
        	}
		
			throw new Exception('Class "' . $className . '" could not be autoloaded'); 
			}
    	}
	}
	
	public function start(){
		$this->init();
	}
}
?>