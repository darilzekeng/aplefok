<?php
require("../_header.php");
require("../includes/fonctions.php");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Textes Aplefok</title>

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

    <style>
        /* gestion liste*/
        .membre ol{
            counter-reset: membre;
        }
        .membre li{ 
            list-style-type: none;
            counter-increment: membre;
            margin-bottom: 10px;
        }
        .membre li:before{
            content: counter(membre);
            padding: 2px 20px 6px;
            margin-right: 8px;
            vertical-align: top;
            background: #678;
            -moz-border-radius:60px;
            border-radius:60px;
            font-weight: bold;
            font-size: 0.8em;
            color: white;
        }
        /* fin liste*/
        .pdf{
            width: 100%;
            height: 400px;
            
        }
    </style>
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
                        Textes ralatif aux aides
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        <br>
                        
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-12 -->

        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-primary">
                   <div class="panel-heading">
                        Textes ralatif aux aides
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <embed class="pdf" src="../test.pdf"></embed>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-12 -->

        </div>
        
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-primary">
                   <div class="panel-heading">
                        <span class="text-center">Groupes de réception de l'année 2020-2021</span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <strong>Groupe 1 (Février 2021)</strong>
                        <ol class="membre">
                            <li class="li-membre">ZEKENG DARRYL </li>
                            <li class="li-membre">HIVER GAHA (<span class="strong dfn">Chef de groupe</span>)</li>
                            <li class="li-membre">FOUDA Eboutou </li>
                        </ol>
                        <strong>Groupe 2 (Mars 2021)</strong>
                        <ol class="membre">
                            <li class="li-membre">ZEKENG DARRYL </li>
                            <li class="li-membre">HIVER GAHA </li>
                            <li class="li-membre">FOUDA Eboutou </li>
                        </ol>
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
