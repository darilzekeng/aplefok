<?php
require("../_header.php");
?>
<?php
if (!empty($_POST)) {
	$errors = array();

	$nom = "";
	$prenom = "";
	$sexe = "Masculin";
	$numero = "";
	$mail = "";
	$mdp = "";
	$cmdp = "";
	$admin = 0;


	if (isset($_POST['utilisateur'])) {
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$numero = $_POST['num_tel'];
		$mail = $_POST['mail'];
		$mdp = $_POST['mdp'];
		$cmdp = $_POST['cmdp'];
		$admin = (isset($_POST['admin'])) ? 1 : 0;
	}

	if (isset($_POST['utilisateur'])) {
		if (empty($nom) || !preg_match("/^[a-zA-Z0-9 \-_]+$/", $nom)) {
			$errors['nom'] = "Votre nom n'est pas valide";
		}

		if (empty($prenom) || !preg_match("/^[a-zA-Z0-9 \-_]+$/", $prenom)) {
			$errors['prenom'] = "Votre prenom n'est pas valide";
		}

		/*if (!isset($_POST['sexe_utilisateur'])) {
			$errors['sexe'] = "Veullez renseigner votre sexe";
		}*/

		if (empty($numero) || !preg_match("/^[0-9]+$/", $numero)) {
			$errors['numero'] = "Votre numéro n'est pas valide";
		}

		if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$errors['mail'] = "Votre email n'est pas valide";
		}else{
			$req = $DB->query('SELECT id FROM membres WHERE email=:email', array('email'=>$mail));

			if ($req) {
				$errors['mail'] = "Cette adresse email est déja utilisée";	
			}
		}

		if (empty($mdp) || $mdp != $cmdp) {
			$errors['mdp'] = "Vous devez renseigner un mot de passe valide";
		}

		if (empty($errors)){

		    // On enregistre les informations dans la base de données 
		    $mdp1 = sha1($mdp);
		    $req = $DB->insert('INSERT INTO membres SET is_admin=:is_admin, nom=:nom, prenom=:prenom, sexe=:sexe, telephone=:telephone, email=:email, password=:password, date_ajout=:date_ajout', 
		    	array('is_admin'=>$admin, 'nom'=>$nom, 'prenom'=>$prenom, 'sexe'=>$sexe, 'telephone'=>$numero, 'email'=>$mail, 'password'=>$mdp1, 'date_ajout'=>date('Y-m-d'))
		    	);
		    //$user_id = $DB->getLastId(); $user_id=1;

		    
		    // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
		    //$password = password_hash($mdp, PASSWORD_BCRYPT);
		    // On génère le token qui servira à la validation du compte 
		    //$token = str_random(60);
		    
		    // On envoit l'email de confirmation
		    //mail($mail, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/AMONDA/connexion/confirm.php?id=$user_id&token=$token");
		    // On redirige l'utilisateur vers la page de login avec un message flash
		    $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
		    //header('Location: connexion.php');
		    header('Location: ../pages/cotisation.php');
		    exit(); 

		}
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

    <title>Aplefok Inscription </title>

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

			<br><br>
			<!-- Inclusion des messages flash -->
      		<?php require("../includes/flashMessage.php"); ?> 
			<!-- Contnu des onglets -->
			<div class="tab-content">

				<form action="" method="POST" role="form" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3" for="label-1-2">Nom</label>
						<div class="col-md-8">
						   <input type="text" class="form-control" name="nom" id="nom" size="10" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];} ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3" for="label-1-2">Prénom</label>
						<div class="col-md-8">
						   <input type="text" class="form-control" name="prenom" id="prenom" size="10" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];} ?>">
						</div>
					</div>
					<div class="form-group">
				
					</div>
				   <div class="form-group">
						<label class="col-sm-3" for="numero_de_telephone">Numéro de téléphone</label>
						<div class="col-md-8">
						   <input type="tel" class="form-control" name="num_tel" id="num_tel" size="10" value="<?php if(isset($_POST['num_tel'])){echo $_POST['num_tel'];} ?>">
						</div>
					</div>
					<div class="form-group">
					 <label class="col-sm-3" for="adresse_email">Adresse email</label>
					<div class="col-md-8">
					   <input type="mail" class="form-control" name="mail" id="mail" size="10" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];} ?>">
					</div>
				   </div>
				   <div class="form-group">
					 <label class="col-sm-3" for="mot_de_passe">Mot de passe</label>
					<div class="col-md-8">
					   <input type="password" class="form-control" name="mdp" id="mdp" size="10">
					</div>
				   </div>
					<div class="form-group">
					 <label class="col-sm-3" for="confirmer_mot_de_passe">Confirmer mot de passe</label>
					<div class="col-md-8">
					   <input type="password" class="form-control" name="cmdp" id="cmdp" size="10">
					</div>
				   </div>
					<div class="form-group">
					    <label for="admin">Admin</label>
					        <input type="checkbox" id="admin" name="admin">
					</div>
				  <div class="form-group">
					<div class="col-sm-offset-6 col-sm-10">
						<button type="submit" name="utilisateur" class="btn btn-default">Confirmer</button>
						<button type="reset" class="btn btn-default">Annuler</button>
					</div>
				  </div>
				</form>
			</div>
		</div><!-- /Contenu -->
	</div><!-- /Container -->
	

	<!--script -->
	<script>// <!&#91;CDATA&#91;
	  $('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	  })
	// &#93;&#93;></script>
	
  </body>
</html>
