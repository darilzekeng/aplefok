 <?php 
 require("../_header.php"); 
require("../includes/fonctions.php");
if (!isLogged()) {
    header("Location:javascript://history.go(-1)");
    exit();
}
 ?> 

<?php
//entete du tableau
$header = array('Mois', 'Membre', 'Appéritif', 'Secours', 'Epargne', 'Aide', 'Fête', 'Crédit', 'Remboursement');
//données à afficher dans le tableau
$data = array(array('Decembre-2021', 'Zekeng Daryl', '10000 F', 'Secours', 'Epargne', 'Aide', 'Fête', 'Crédit', 'Remboursement'), 
    array('Février', 'Membre', 'Appéritif', 'Secours', 'Epargne', 'Aide', 'Fête', 'Crédit', 'Remboursement'));

//charger les informations des élèves dans un tableau
function loadData(){
    $data = array();
    return $data;
}
$id = $_SESSION['auth']->id;
$etats = $membres = $DB->query("SELECT mois_annee,nom,prenom,apperitif,secours,epargne,aide,fete,credit,remboursement FROM membres m, cotisation c WHERE m.id=c.id_membre AND m.id=:id ORDER BY mois_annee",array('id'=>$id));
$tab_etats = array();
$nom_prenom = '';
foreach ($etats as $etat) {
    $t = array();
    $t[] = $etat->mois_annee;
    $t[] = $etat->nom;
    $t[] = $etat->prenom;
    $t[] = $etat->secours.' F';
    $t[] = $etat->epargne.' F';
    $t[] = $etat->aide.' F';
    $t[] = $etat->fete.' F';
    $t[] = $etat->credit.' F';
    $t[] = $etat->remboursement.' F';
    $tab_etats[] = $t;
}
$data = $tab_etats;
$nom_prenom = $etat->nom.' '.$etat->prenom;
//var_dump($t);
?>

<style type="text/css">
    .table-bordered {border-width: 0.25mm; border-style: solid; border-color: #000000;padding:1mm;}
	.content{font-size:3mm;}
    .cadre{border: 0.3mm solid black; display: inline; width: 40%; font-size: 3mm; text-align: center; position: relative;}
</style>
<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <div>
        <div class="cadre">
            MINISTERE DES ENSEIGNEMENTS SECONDAIRES<br>
            DELEGATION REGIONALE DU CENTRE <br>
            DELEGATION DEPARTEMENTALE D'OBALA <br>
            LYCEE D'EFOK
        </div>
        <div class="cadre" style="margin-left: 0.8%; margin-right: 0.8%; width: 17%;">
            <img src="./res/logo.png" alt="Logo de l'établissement" style="width: 100%">
        </div>
        <div class="cadre">
                REPUBLIQUE DU CAMEROUN <br>
                Paix-Travail-Patrie <br>
                ANNEE SCOLAIRE 2019-2020 
        </div>
    </div>
	<h3>Amicaliste: <?= $nom_prenom ?> </h3>
    <table style="border-collapse: collapse;">
        <col class="table-bordered content" style="width: 13%;">
        <col class="table-bordered content" style="width: 15%;">
        <col class="table-bordered content" style="width: 9%;">
        <col class="table-bordered content" style="width: 9%;">
        <col class="table-bordered content" style="width: 9%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 15%;">
        <tr>
            <th style="border: solid 1px black">Mois</th>
            <th style="border: solid 1px black">Membre</th>
			<th style="border: solid 1px black">Appéritif</th>
            <th style="border: solid 1px black">Secours</th>
            <th style="border: solid 1px black">Epargne</th>
            <th style="border: solid 1px black">Aide</th>
            <th style="border: solid 1px black">Fête</th>
            <th style="border: solid 1px black">Crédit</th>
            <th style="border: solid 1px black">Remboursement</th>
        </tr>
        <!-- Affichagee des lignes du tableau -->
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row[0] ?></td>
                <td><?= $row[1] ?></td>
                <td><?= $row[2] ?></td>
                <td><?= $row[3] ?></td>
                <td><?= $row[4] ?></td>
                <td><?= $row[5] ?></td>
                <td><?= $row[6] ?></td>
                <td><?= $row[7] ?></td>
                <td><?= $row[8] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <page_footer>
        <hr>
        <p style="text-align: right;">page [[page_cu]]/[[page_nb]]</p>
    </page_footer>

</page>