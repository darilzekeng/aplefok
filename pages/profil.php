<?php
require("../_header.php");
require("../includes/fonctions.php");


if (!isLogged()) {
	header("Location:javascript://history.go(-1)");
	exit();
}
?>

<?php 
$id = $_SESSION['auth']->id;
$membres = $DB->query("SELECT * FROM membres m, cotisation c WHERE m.id=c.id_membre AND m.id=:id ORDER BY mois_annee",array('id'=>$id));
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplefok Profil</title>

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
            <div class="col-md-12">
                <div class="panel panel-default">
                   <div class="panel-heading">
                        Profil de  <span class="text-primary"> <?= $_SESSION['auth']->nom.' '.$_SESSION['auth']->prenom; ?> </span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>Noms</th>
                                    <td><?= $_SESSION['auth']->nom ?></td>
                                </tr>
                                <tr>
                                    <th>Prénoms</th>
                                    <td><?= $_SESSION['auth']->prenom ?></td>
                                </tr>
                                <tr>
                                    <th>Sexe</th>
                                    <td><?= $_SESSION['auth']->sexe ?></td>
                                </tr>
                                <tr>
                                    <th>Numéro de téléphone</th>
                                    <td><?= $_SESSION['auth']->telephone ?></td>
                                </tr>
                                <tr>
                                    <th>Adresse mail</th>
                                    <td><?= $_SESSION['auth']->email ?></td>
                                </tr>
                                <tr>
                                    <th>Date d'inscription</th>
                                    <td><?= $_SESSION['auth']->date_ajout ?></td>
                                </tr>
                                <tr>
                                    <th>Administrateur</th>
                                    <td><?php if($_SESSION['auth']->is_admin==1){echo 'Oui';}else{echo 'Non';} ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-12 -->
        </div>

		<div class="row">

			<div class="col-md-12">
				<div class="panel panel-default">
                   <div class="panel-heading">
                        Etats de <span class="text-primary"> <?= $_SESSION['auth']->nom.' '.$_SESSION['auth']->prenom; ?> </span>
                        <span class="pull-right"><a href="../imprimer/students_list.php"  class="btn btn-success"><i class="fa fa-print"></i> Imprimer</a></span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                    	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                	<th>Mois</th>
                                    <th>Membre</th>
									<th>Appéritif</th>
                                    <th>Secours</th>
                                    <th>Epargne</th>
                                    <th>Aide</th>
									<th>Fête</th>
                                    <th>Crédit</th>
                                    <th>Remboursement</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php foreach($membres as $membre): ?>
                            		<tr class="gradeA">
                            			<td><?= $membre->mois_annee ?></td>
	                            		<td><?= $membre->nom. ' '. $membre->nom ?></td>
	                            		<td><?= $membre->apperitif ?> Fcfa</td>
	                            		<td><?= $membre->secours ?> Fcfa</td>
	                            		<td><?= $membre->epargne ?> Fcfa</td>
	                            		<td><?= $membre->aide ?> Fcfa</td>
	                            		<td><?= $membre->fete ?> Fcfa</td>
	                            		<td><?= $membre->credit ?> Fcfa</td>
	                            		<td><?= $membre->remboursement ?> Fcfa</td>
                            		</tr>
                            	<?php endforeach; ?>
                            </tbody>
                    	</table>
                    	<!-- /.table-responsive -->
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
