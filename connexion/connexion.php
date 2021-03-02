<?php 
require_once('../includes/fonctions.php');
require("../_header.php");
?>

<?php
if (isset($_COOKIE['souvenir'])) {
	$remember_token = $_COOKIE['souvenir'];
	$parts = explode('==', $remember_token);
	$user_id = $parts['0'];

	$user = $DB->query('SELECT * FROM membres WHERE id=:id', array('id'=>$user_id));
	if ($user) {
		foreach ($user as $user1) {
			$utilisateur = $user1;
		}

		$expected = $user_id. '=='. $utilisateur->remember_token.sha1($utilisateur->id.'amonda');
		if ($expected == $remember_token) {
			echo'Vous etes bien connecté';
			$_SESSION['auth'] = $utilisateur;
		}else{
			setcookie('souvenir', null, -1);
		}
	}else{
		setcookie('souvenir', null, -1);
	}
}

if (isset($_POST) && !empty($_POST) && !empty($_POST['mail']) && !empty($_POST['mdp'])) {
	$mdp = sha1($_POST['mdp']);
	$user = $DB->query('SELECT * FROM membres WHERE email=:email AND password=:mdp', array('email'=>$_POST['mail'], 'mdp'=>$mdp));

	if ($user) {
		foreach ($user as $user1) {
			$utilisateur = $user1;
		}

		$_SESSION['auth'] = $utilisateur;
		$_SESSION['flash']['success'] = 'Vous êtes maintenant connecté au site '; echo "bienvenu";
		//se souvenir de l'utilisateur
		if(isset($_POST['souvenir'])){
		    $remember_token = str_random(250);
		    $user = $DB->insert('UPDATE membres SET remember_token=:token WHERE id=:id', array('token'=>$remember_token, 'id'=>$utilisateur->id));
		    setcookie('souvenir', $utilisateur->id . '==' . $remember_token . sha1($utilisateur->id . 'amonda'), time() + 60 * 60 * 24 * 14);
		}
		//header('Location: profil.php');
		$redirect = (isset($_SESSION['redirect']) ? $_SESSION['redirect'] : '../index.php' );
		header('Location: '.$redirect);
		exit();
		debug($utilisateur);
		
	}else{
		$_SESSION['flash']['danger'] = 'Vos identifiants sont invalides';
	}
}else{
	$_SESSION['flash']['danger'] = 'Veuillez renseigner votre mail et votre mot de passe';
}


?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplefok connexion</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="css/favicon.png">

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../bootstrap/dist/js/bootstrap.js"></script>
  </head>

  <body  style="background-color:white;">
  	<!-- Inclusion du header de la page -->
  <?php require("../header.php"); ?>  
	<div class="container">
		<div id="contenu" class="col-sm-offset-4 col-sm-5" style="background-color:#dcdcdc; background-image: url('../img/fond_inscription.png');background-repeat: no-repeat;background-position: top center;">
				
			<!-- Inclusion des messages flash -->
			<?php include '../includes/flashMessage.php'; ?>

			<br><br>
			<form method="post" action="">
			   <div class="form-group row">
				 <label class="col-sm-3" for="mot_de_passe">Adresse mail</label>
				<div class="col-md-8">
				   <input type="mail" class="form-control" name="mail" id="mail" size="10">
				</div>
			   </div>
				<div class="form-group row">
				 <label class="col-sm-3" for="mdp">Mot de passe</label>
				<div class="col-md-8">
				   <input type="password" class="form-control" name="mdp" id="mdp" size="10">
				</div>
			   </div>
			   <div class="col-sm-offset-3 col-sm-10">
				<a href="mdp_oublie.php">Mot de passe oublié ?</a>
			  </div>
			   <div class="form-group">
				<div class="col-sm-offset-3 col-sm-10">
					<div class="checkbox">
						<label><input type="checkbox" name="souvenir" value="1" /> Se souvenir de moi</label>
					</div>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-6 col-sm-10">
					<button type="submit" name="connecter" class="btn btn-default">Se connecter</button>
					<button type="reset" class="btn btn-default">Annuler</button>
				</div>
			  </div>
			</form>
		</div><!-- /Contenu -->
	</div><!-- /Container -->
	

	
  </body>
</html>
