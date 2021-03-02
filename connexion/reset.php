<?php 
require_once('../includes/fonctions.php');
require("../_header.php");
?>

<?php
if(isset($_GET['id']) && isset($_GET['token'])) {
	$user = $DB->query('SELECT * FROM membres WHERE id=:id AND date_ajout_client IS NOT NULL', array('id'=>$_GET['id']));
	//$user = $DB->query('SELECT * FROM users WHERE id =:id AND reset_mdp_client IS NOT NULL AND reset_mdp_client =:reset AND date_modification_client > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', array('id'=>$_GET['id'], 'reset'=>$_GET['token']));


	if ($user) {
		foreach ($user as $user1) {
			$utilisateur = $user1;
		}

		if (!empty($_POST)) {
			if (!empty($_POST['mdp']) && $_POST['mdp'] == $_POST['cmdp'] ) {
				$password = $_POST['mdp'];
				$user = $DB->insert('UPDATE membres SET password=:password, date_modification_client=NULL, reset_mdp_client=NULL WHERE id=:id', array('password'=>$password,'id'=>$_GET['id']));
				$_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
				$_SESSION['auth'] = $utilisateur;
				//header('Location: account.php');
				exit();
			}
		}
		
	}else{
		$_SESSION['flash']['error'] = 'Ce token n\'est pas valide';
	}

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
				 <label class="col-sm-3" for="mdp">Mot de passe</label>
				<div class="col-md-8">
				   <input type="password" class="form-control" name="mdp" id="mdp" size="10">
				</div>
			   </div>
			   <div class="form-group row">
				 <label class="col-sm-3" for="mdp">Confirmer mot de passe</label>
				<div class="col-md-8">
				   <input type="password" class="form-control" name="cmdp" id="mdp" size="10">
				</div>
			   </div>
			  <div class="form-group">
				<div class="col-sm-offset-6 col-sm-10">
					<button type="submit" name="connecter" class="btn btn-default">Réinitialiser</button>
				</div>
			  </div>
			</form>
		</div><!-- /Contenu -->
	</div><!-- /Container -->
	

	
  </body>
</html>
