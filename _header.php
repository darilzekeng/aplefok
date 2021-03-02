<?php
session_start();
require 'classes/db.class.php';
$DB = new DB();

require_once 'classes/autoloader.class.php'; Autoloader::register();

//Définition des paramètres globaux du site

define('LOGO', 'mon_logo');
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
//$link1 = htmlspecialchars($url,ENT_QUOTES, 'UTF-8');
$url = "//{$_SERVER['HTTP_HOST']}/aplefok/";
$link1 = htmlspecialchars($url,ENT_QUOTES, 'UTF-8');
define('LINK', $link1);

?>