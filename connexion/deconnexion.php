<?php
session_start();
$_SESSION[] = array();
session_destroy();
setcookie('souvenir', NULL, -1);//suppression du cookie
$_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';
header("Location: connexion.php");
?>