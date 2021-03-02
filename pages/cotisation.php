<?php 
require("../_header.php");
require("../includes/fonctions.php");

if (!isAdmin()) {
	$_SESSION['flash']['danger'] = 'Vous n\'avez pas accès à cette page. veuillez contacter l\'administrateur pour plus d\'informations.' ;
	header("Location:javascript://history.go(-1)");
	exit();
}
?>

<?php 
$membres = $DB->query('SELECT id,nom,prenom FROM membres');
$mois = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre');
//var_dump($membres);
?>

<?php
if (!empty($_POST)) {
	$errors = array();

	$membre = "";
	$date = "";
	$apperitif = 0;
	$secours = 0;
	$epargne = 0;
	$aide = 0;
	$fete = 0;
	$observation = "";
	$montant = 0;


	if (isset($_POST['cotisation'])) {
		//Initialisation des variables
		$membre = $_POST['membre'];
		$date = $_POST['date'];
		$apperitif = $_POST['apperitif'];
		$secours = $_POST['secours'];
		$epargne = $_POST['epargne'];
		$aide = $_POST['aide'];
		$fete = $_POST['fete'];
		$observation = "";

		if ($membre=='--') {
			$errors['membre'] = "Veuillez choisir un amicaliste";
		}
		if ($date=='--') {
			$errors['date'] = "Veuillez choisir une date";
		}

		//Traitement de la requete en cas d'abscence d'erreur
		if (empty($errors)) {
			$date1 = $date . '-'. date('Y');

			$exist = $DB->query('SELECT id_cotisation FROM cotisation WHERE mois_annee=:mois_annee AND id_membre=:id_membre', 
				array('mois_annee'=>$date1,'id_membre'=>$membre));
			if ($exist) {
				$req = $DB->insert('UPDATE cotisation SET id_membre=:id_membre, mois_annee=:mois_annee, apperitif=:apperitif, secours=:secours, epargne=:epargne, aide=:aide, fete=:fete, observation=:observation WHERE id_membre=:id_membre AND mois_annee=:mois_annee', 
			    	array('id_membre'=>$membre, 'mois_annee'=>$date1, 'apperitif'=>$apperitif, 'secours'=>$secours, 'epargne'=>$epargne, 'aide'=>$aide, 'fete'=>$fete, 'observation'=>$observation)
			    	); 
			}else{
			    $req = $DB->insert('INSERT INTO cotisation SET id_membre=:id_membre, mois_annee=:mois_annee, apperitif=:apperitif, secours=:secours, epargne=:epargne, aide=:aide, fete=:fete, observation=:observation', 
			    	array('id_membre'=>$membre, 'mois_annee'=>$date1, 'apperitif'=>$apperitif, 'secours'=>$secours, 'epargne'=>$epargne, 'aide'=>$aide, 'fete'=>$fete, 'observation'=>$observation)
			    	); 
			}
			$_SESSION['flash']['success'] = 'Votre cotisation a bien été enrégistrée';
			header('Location: cotisation.php');
		    exit();
		}
	}else if (isset($_POST['pret'])){
		//Initialisation des variables
		$membre = $_POST['membre'];
		$date = $_POST['date'];
		$montant = $_POST['montant'];

		//Initialisation des erreurs
		if ($membre=='--') {
			$errors['membre'] = "Veuillez choisir un amicaliste";
		}
		if ($date=='--') {
			$errors['date'] = "Veuillez choisir une date";
		}
		if ($montant<=0) {
			$errors['montant'] = "Veuillez entrer un montant superieur à 0";
		}

		//Traitement de la requete en cas d'abscence d'erreur
		if (empty($errors)) {
			echo "Pas d'erreur";
			$_SESSION['flash']['success'] = 'Votre emprunt a été éffectué avec succès';
		}

	}else if (isset($_POST['remboursement'])){

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

    <title>Cotisation Aplefok</title>

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
			<!-- Nav onglets -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#home" data-toggle="tab">?</a></li>
				<li><a href="#cotisation" data-toggle="tab">Cotisations</a></li>
				<li><a href="#pret" data-toggle="tab">Prêts</a></li>
				<li><a href="#remboursement" data-toggle="tab">Remboursements</a></li>
			</ul>
			<br><br>
			<!-- Affichage des erreurs -->
			<?php require("../includes/flashMessage.php"); ?>  
			
			<!-- Contnu des onglets -->
			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					Binvenu dans la page de gestion des cotisations et des emprunts d'argents 
					<br> <a href="../connexion/inscription.php">Inscrire un amicaliste ?</a>
				</div>

				<div id="cotisation" class="tab-pane fade">
					<form action="" method="POST" role="form" class="form-horizontal">
						<div class="form-group">
						    <label class="col-sm-3" for="date">Date</label>
						    <div class="col-md-8">
							    <select class="form-control" id="date" name="date">
							    	<option value="--">Veuillez choisir un mois</option>
									<?php foreach($mois as $moi): ?>
										<option value="<?= $moi; ?>"><?= $moi; ?></option>
									<?php endforeach; ?>
							    </select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3" for="membre">Membre</label>
						    <div class="col-md-8">
							    <select class="form-control" id="membre" name="membre">
							    	<option value="--">Veuillez choisir un amicaliste</option>
									<?php foreach($membres as $membre): ?>
										<option value="<?= $membre->id; ?>"><?= $membre->nom; ?></option>
									<?php endforeach; ?>
							    </select>
						    </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="apperitif">Appéritif</label>
							<div class="col-md-8">
							   <input type="number" class="form-control" name="apperitif" id="apperitif" size="10" value="<?php if(isset($_POST['apperitif'])){echo $_POST['apperitif'];}else{echo 1000;} ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="secours">Secours</label>
							<div class="col-md-8">
							   <input type="number" class="form-control" name="secours" id="secours" size="10" value="<?php if(isset($_POST['secours'])){echo $_POST['secours'];}else{echo 2000;} ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="epargne">Epargne</label>
							<div class="col-md-8">
							   <input type="number" class="form-control" name="epargne" id="epargne" size="10" value="<?php if(isset($_POST['epargne'])){echo $_POST['epargne'];}else{echo 1000;} ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="aide">Aide</label>
							<div class="col-md-8">
							   <input type="number" class="form-control" name="aide" id="aide" size="10" value="<?php if(isset($_POST['aide'])){echo $_POST['aide'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="fete">Fête</label>
							<div class="col-md-8">
							   <input type="number" class="form-control" name="fete" id="fete" size="10" value="<?php if(isset($_POST['fete'])){echo $_POST['fete'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="fete">Survetement</label>
							<div class="col-md-8">
							   <input type="number" class="form-control" name="fete" id="fete" size="10" value="<?php if(isset($_POST['fete'])){echo $_POST['fete'];} ?>">
							</div>
						</div>
					  <div class="form-group">
						<div class="col-sm-offset-6 col-sm-10">
							<button type="submit" name="cotisation" class="btn btn-default">Confirmer</button>
							<button type="reset" class="btn btn-default">Annuler</button>
						</div>
					  </div>
					</form>
				</div> <!-- /cotisation-->

				<div id="pret" class="tab-pane fade">
					<form action="" method="POST" role="form" class="form-horizontal">
						<div class="form-group">
						    <label class="col-sm-3" for="date">Date</label>
						    <div class="col-md-8">
							    <select class="form-control" id="date" name="date">
							    	<option value="--">Veuillez choisir un mois</option>
									<?php foreach($mois as $moi): ?>
										<option value="<?= $moi; ?>"><?= $moi; ?></option>
									<?php endforeach; ?>
							    </select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3" for="membre">Membre</label>
						    <div class="col-md-8">
							    <select class="form-control" id="membre" name="membre">
							    	<option value="--">Veuillez choisir un amicaliste</option>
									<?php foreach($membres as $membre): ?>
										<option value="<?= $membre->id; ?>"><?= $membre->nom; ?></option>
									<?php endforeach; ?>
							    </select>
						    </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="montant">Montant </label>
							<div class="col-md-8">
							   <input type="number" class="form-control" name="montant" id="montant" size="10" value="<?php if(isset($_POST['montant'])){echo $_POST['montant'];} ?>">
							</div>
						</div>
					  <div class="form-group">
						<div class="col-sm-offset-6 col-sm-10">
							<button type="submit" name="pret" class="btn btn-default">Confirmer</button>
							<button type="reset" class="btn btn-default">Annuler</button>
						</div>
					  </div>
					</form>
				</div><!-- /pret-->

				<div id="remboursement" class="tab-pane fade">
					<form action="" method="POST" role="form" class="form-horizontal">
						<div class="form-group">
						    <label class="col-sm-3" for="date">Date</label>
						    <div class="col-md-8">
							    <select class="form-control" id="date" name="date">
							    	<option value="--">Veuillez choisir un mois</option>
									<?php foreach($mois as $moi): ?>
										<option value="<?= $moi; ?>"><?= $moi; ?></option>
									<?php endforeach; ?>
							    </select>
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3" for="membre">Membre</label>
						    <div class="col-md-8">
							    <select class="form-control" id="membre" name="membre">
							    	<option value="--">Veuillez choisir un amicaliste</option>
									<?php foreach($membres as $membre): ?>
										<option value="<?= $membre->id; ?>"><?= $membre->nom; ?></option>
									<?php endforeach; ?>
							    </select>
						    </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="montant">Montant </label>
							<div class="col-md-8">
							   <input type="number" class="form-control" name="montant" id="montant" size="10" value="<?php if(isset($_POST['montant'])){echo $_POST['montant'];} ?>">
							</div>
						</div>
					  <div class="form-group">
						<div class="col-sm-offset-6 col-sm-10">
							<button type="submit" name="remboursement" class="btn btn-default">Confirmer</button>
							<button type="reset" class="btn btn-default">Annuler</button>
						</div>
					  </div>
					</form>
				</div><!-- /remboursement-->
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
