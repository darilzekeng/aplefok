<?php
/**
* class App
* Permet de gérer les configurations diverses
*/

class App{

	/**
	* @var string instance de connexion à la BDD
	*/
	private $DB;

	public function __construct($DB){
		$this->DB = $DB;
	}
	
	/**
	*faire une redirection et un exit
	*@param String $url adresse ou on doit rediriger l'utilisateur
	*/
	public static function redirect($url){
	    if(is_file($url) OR is_dir($url)){
	        header('Location: '.$url);
	        exit();        
	    }
	}

}
