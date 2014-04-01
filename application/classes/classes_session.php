<?php
class classes_session{
	public function __construct(){
		session_start();
	}
	
	public function getAttr($attr){
		if(isset($_SESSION[$attr])){
			return $_SESSION[$attr];
		}
		return false;
	}
	
	public function setAttr($name,$value){
		return $_SESSION[$name] = $value;
	}
}
?>