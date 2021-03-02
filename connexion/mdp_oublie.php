<?php 
require_once('../includes/fonctions.php');
require("../_header.php");
?>

<?php
if (isset($_POST) && !empty($_POST['mail'])) {
	$user = $DB->query('SELECT * FROM membres WHERE email=:email AND date_ajout_client IS NOT NULL', array('email'=>$_POST['mail']));

	if ($user) {
		foreach ($user as $user1) {
			$utilisateur = $user1;
		}


		$reset_token = str_random(60);
		$user = $DB->insert('UPDATE membres SET reset_mdp_client=:reset, date_modification_client=NOW() WHERE id=:id', array('reset'=>$reset_token, 'id'=>$utilisateur->id));
		$_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par emails';
		mail($_POST['mail'], 'Réinitiatilisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://localhost/aplefok/connexion/reset.php?id={$utilisateur->id}&token=$reset_token");
		header('Location: connexion.php');
		exit();
		
	}else{
		$_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adressse email';
	}
}else{
	$_SESSION['flash']['danger'] = 'Veuillez renseigner une adresse valide';
}


?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AMONDA</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="css/favicon.png">

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../bootstrap/dist/js/bootstrap.js"></script>
  </head>

  <body  style="background-color:white;">
	<div class="container">
		<div id="contenu" class="col-sm-offset-4 col-sm-5" style="background-color:#dcdcdc; background-image: url('../img/fond_inscription.png');background-repeat: no-repeat;background-position: top center;">
				
			<?php if(isset($_SESSION['flash'])): ?>
				<?php foreach($_SESSION['flash'] as $type => $message): ?>
					<div class="alert alert-<?= $type; ?>">
						<?= $message; ?>
					</div>
				<?php endforeach; ?>
				<?php unset($_SESSION['flash']); ?>
			<?php endif; ?>
			<br><br>
			<form method="post" action="">
			   <div class="form-group row">
				 <label class="col-sm-3" for="mot_de_passe">Adresse mail</label>
				<div class="col-md-8">
				   <input type="email" class="form-control" name="mail" id="mail" size="10">
				</div>
			   </div>
			  <div class="form-group">
				<div class="col-sm-offset-6 col-sm-10">
					<button type="submit" name="connecter" class="btn btn-default">Se connecter</button>
				</div>
			  </div>
			</form>
		</div><!-- /Contenu -->
	</div><!-- /Container -->
	

	
  </body>
</html>
