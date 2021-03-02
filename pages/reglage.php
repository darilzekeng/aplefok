<?php
require("../_header.php");
require("../includes/fonctions.php");

if (!isLogged()) {
	header("Location:javascript://history.go(-1)");
	exit();
}
?>

<?php 
$membre = $_SESSION['auth'];

if (!empty($_POST)) {
    $errors = array();

    $nom = "";
    $prenom = "";
    $sexe = "Masculin";
    $numero = "";
    $mail = "";
    $mdp = "";
    $cmdp = "";

    if (isset($_POST['infos_perso'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $numero = $_POST['num_tel'];
        $mail = $_POST['mail'];
    }

    if (isset($_POST['infos_perso'])) {
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
            /*
            if ($req) {
                $errors['mail'] = "Cette adresse email est déja utilisée";  
            }
            */
        }

        if (empty($errors)){
            // On enregistre les informations dans la base de données 
            $req = $DB->insert('UPDATE  membres SET nom=:nom, prenom=:prenom, sexe=:sexe, telephone=:telephone, email=:email WHERE id=:id', 
                array('nom'=>$nom, 'prenom'=>$prenom, 'sexe'=>$sexe, 'telephone'=>$numero, 'email'=>$mail,'id'=>$membre->id)
                );
            // On redirige l'utilisateur vers la page de login avec un message flash
            $_SESSION['flash']['success'] = 'Vos informations personnelles on été modifiées avec succès';
            header('Location: profil.php');
            exit(); 

        }
    }else if (isset($_POST['infos_con'])) {
        $mdp = $_POST['mdp'];
        $cmdp = $_POST['cmdp'];

        if (empty($mdp) || $mdp != $cmdp) {
            $errors['mdp'] = "Vous devez renseigner un mot de passe valide";
        }

        if (empty($errors)){
            $mdp1 = sha1($mdp);
            $req = $DB->insert('UPDATE membres SET password=:password WHERE id=:id', 
                array('password'=>$mdp1, 'id'=>$membre->id)
                );
            $_SESSION['flash']['success'] = 'Vos informations de connexion on été modifiées avec succès';
            header('Location: profil.php');
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

    <title>Aplefok Réglages</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../css/favicon.png">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

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
		<!-- Inclusion des messages flash -->
		<?php require("../includes/flashMessage.php"); ?> 

        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="panel panel-default">
                   <div class="panel-heading">
                         Modifier mes informations personnelles
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form action="" method="POST" role="form" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3" for="label-1-2">Nom</label>
                                <div class="col-md-8">
                                   <input type="text" class="form-control" name="nom" id="nom" size="10" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];}else{echo $membre->nom;} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3" for="label-1-2">Prénom</label>
                                <div class="col-md-8">
                                   <input type="text" class="form-control" name="prenom" id="prenom" size="10" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];}else{echo $membre->prenom;} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                        
                            </div>
                           <div class="form-group">
                                <label class="col-sm-3" for="numero_de_telephone">Numéro de téléphone</label>
                                <div class="col-md-8">
                                   <input type="tel" class="form-control" name="num_tel" id="num_tel" size="10" value="<?php if(isset($_POST['num_tel'])){echo $_POST['num_tel'];}else{echo $membre->telephone;} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                             <label class="col-sm-3" for="adresse_email">Adresse email</label>
                            <div class="col-md-8">
                               <input type="mail" class="form-control" name="mail" id="mail" size="10" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];}else{echo $membre->email;} ?>">
                            </div>
                           </div>
                          <div class="form-group">
                            <div class="col-sm-offset-6 col-sm-10">
                                <button type="submit" name="infos_perso" class="btn btn-default">Modifier</button>
                                <button type="reset" class="btn btn-default">Annuler</button>
                            </div>
                          </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-12 -->
        </div>

		<div class="row">

			<div class="col-md-offset-2 col-md-8">
				<div class="panel panel-default">
                   <div class="panel-heading">
                         Modifier mes informations de connexion
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                    	<form action="" method="POST" role="form" class="form-horizontal">
                           <div class="form-group">
                             <label class="col-sm-3" for="mot_de_passe">Nouveau mot de passe</label>
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
                            <div class="col-sm-offset-6 col-sm-10">
                                <button type="submit" name="infos_con" class="btn btn-default">Modifier</button>
                                <button type="reset" class="btn btn-default">Annuler</button>
                            </div>
                          </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-md-12 -->

		</div>
	</div><!-- /Container -->
	
	<!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "language": {
                "sProcessing": "Traitement en cours ...",
                "sLengthMenu": "Afficher _MENU_ lignes",
                "sZeroRecords": "Aucun résultat trouvé",
                "sEmptyTable": "Aucune donnée disponible",
                "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
                "sInfoEmpty": "Aucune ligne affichée",
                "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
                "sInfoPostFix": "",
                "sSearch": "Chercher:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Chargement...",
                "oPaginate": {
                  "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
                },
                "oAria": {
                  "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
                }
            }
        });
    });
    </script>

	<!--script -->
	<script>// <!&#91;CDATA&#91;
	  $('#myTab a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	  })
	// &#93;&#93;></script>
	
  </body>
</html>
