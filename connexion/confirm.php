<?php

require_once('../_header.php');

$user_id = $_GET['id'];
$token = $_GET['token'];

$user = $DB->query('SELECT * FROM membres WHERE id=:id', array('id'=>$user_id));

foreach ($user as $user1) {
	$user_token = $user1->confirmer_mdp_client;
}

if($user && $user_token == $token){ //&& $user->confirmer_mdp_client ==$token
	//session_start();
	$req = $DB->insert('UPDATE membres SET confirmer_mdp_client = NULL, date_ajout_client = NOW() WHERE id=:id', array('id'=>$user_id));
	$_SESSION['flash']['success'] = 'Votre compte a bien été validé';
	$_SESSION['auth'] = $user;
	//redirection vers le compte de l'utilisateur
	//header('Location: profil.php');
	die('ok');

}else{
	$_SESSION['flash']['success'] = 'Ce token n\'est plus valide';
	//header('Location:login.php');
	die('pas ok');
}
