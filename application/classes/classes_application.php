<?php
class classes_application {
	public function __construct(){}
	
	private function init(){
		/*
		 * Connect to database
		 */
		 $__DB = new classes_DB();
		 classes_config::getInstance();
	}
}
?>