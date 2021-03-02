<?php
class DB{
	private $host = "databases.000webhost.com";
	private $username = 'root';
	private $password = 'DoQ7]UAk%snLZJBe';
	private $database = 'id15552990_aplefok';
	private $db;

	public function __construct($host=null, $username=null, $password=null, $database=null){
		if($host != null){
			$this->host = $host;
			$this->username = $username;
			$this->password = $password;
			$this->database = $database;
		}

		//$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
		try {
			$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, 
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
				));
		} catch (Exception $e) {
			die('<h1>Impossible de se connecter a la base de données</h1>');
		}
		
	}

	public function query($sql, $data = array()){
		$req = $this->db->prepare($sql);
		$req->execute($data);
		return $req->fetchAll(PDO::FETCH_OBJ);
	}

	public function insert($sql, $data = array()){
		$req = $this->db->prepare($sql);
		$req->execute($data);
		return $req;
	}

	public function getLastId(){
		return $this->db->lastInsertId();
	}
}

?>