<?php
/**
* class Autoloader
* Permt d'inclure autommatiquement les classes dont on a besin
*/

class Autoloader{

	/*
	* @param $class_name nom de la classe a charger automatiquement
	*/
	public static function autoload($class_name){
		$class_name = strtolower($class_name);
		require_once $class_name.'.class.php';
	}

	public static function register(){
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}
}

 ?>