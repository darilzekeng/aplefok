<?php
session_start();

// Connexion à la base de données
	$bdd = new PDO('mysql:host=localhost;dbname=client', 'root', '');
	if (isset($_GET['id']))
	{
?>

<html>
	<head>
		<title>PROFIL </title>
		<meta charset="utf-8">
	</head>
	<body>
		<div align="center">
			<h1>PROFIL DE ...</h1>
			<br />
			pseudo = ...
			<br />
			mail = ...
			<a href="deconnexion.php">Se déconnecter</a>

		</div>
	</body>
</html>
<?php
}
else
{
	echo'<h1 color="red">ERRUEUR FATALE</h1>';
}
?>