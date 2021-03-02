<?php
//entete du tableau
$header = array('No', 'Noms et prénoms', 'Sexe');
//données à afficher dans le tableau
$data = array(array(1, 'Zekeng Franc', 'M'), array(2, 'Jhislaine Flore', 'F'));

//charger les informations des élèves dans un tableau
function loadData(){
    $data = array();
    return $data;
}
?>

<style type="text/css">
    .table-bordered {border-width: 0.25mm; border-style: solid; border-color: #000000;padding:1mm;}
	.content{font-size:4mm;}
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
	<h3>Classe: 3ème ESP </h3>
    <table style="border-collapse: collapse;">
        <col class="table-bordered content" style="width: 5%;">
        <col class="table-bordered content" style="width: 80%;">
        <col class="table-bordered content" style="width: 15%;">
        <tr>
            <th style="border: solid 1px black">No</th>
            <th style="border: solid 1px black">Noms et prénoms</th>
			<th style="border: solid 1px black">Sexe</th>
        </tr>
        <!-- Affichagee des lignes du tableau -->
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row[0] ?></td>
                <td><?= $row[1] ?></td>
                <td><?= $row[2] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <page_footer>
        <hr>
        <p style="text-align: right;">page [[page_cu]]/[[page_nb]]</p>
    </page_footer>

</page>