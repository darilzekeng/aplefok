<?php
//entete du tableau
$header = array('Disciplines', 'Enseignants', 'M/20','Coef', 'Total', 'Rang', 'Mention');
//matières littéraires
$data_litt = array(array('ANGLAIS', 'M. Zekeng Franc', 13, 1.0, 39.00, 18, 'Assez Bien'), array('ESPAGNOL', 'NGa EBEDE Martine', 12.00, 2.0, 39.00, 18, 'Assez Bien'));
//matières scientifiques
$data_scientifique = array(array('INFORMATIQUE', 'M. Zekeng Franc', 8.122, 3.0, 39.00, 18, 'Assez Bien'), array('MATHEMATIQUES', 'NGa EBEDE Martine', 13.00, 4, 39.00, 18, 'Assez Bien'));
//matières complémentaires
$data_complementaire = array(array('E.P.S', 'M. Zekeng Franc', 13, 1.0, 39.00, 18, 'Assez Bien'), array('T.M', 'NGa EBEDE Martine', 5.00, 3.0, 39.00, 18, 'Assez Bien'));

//Matière littéraires , scientifiques , complémentaitres

//charger les informations des élèves dans un tableau
function loadData(){
    $data = array();
    return $data;
}

/**
 * Générer un tableau à une entrée à partir d'un tableau multiples entrées  
 * @param array $group tableau à multiples entrées
 * @param int $position entier contenant la position de l'élément à extraire dans le tableau
 * @return array
 */
function getElement(array $group, $position){
    $data = array();
    foreach ($group as $elt) {
        $data[] = $elt[$position];
    }
    return $data;
}

/**
 * Additionner les éléments d'un tableau
 * @param array $elts liste des éléments à sommer
 * @return double
 */
function sumElements(array $elts){
    return (!empty($elts)) ? array_sum($elts) : 0;
}

/**
* @param float $note Note a apprécier
* @return string $appreciation appréciation donnée pour la note
*/
function getAppreciation($mark){
    if($mark>=0 && $mark<=4){
        $appreciation = "null";
    }
    else if($mark>=5 && $mark<=6){
        $appreciation = "Très faible";
    }
    else if($mark>=7 && $mark<8){
        $appreciation = "Faible";
    }
    else if($mark>=8 && $mark<9){
        $appreciation = "Inssufisant";
    }
    else if($mark>=9 && $mark<10){
        $appreciation = "Médiocre";
    }
    else if($mark>=10 && $mark<12){
        $appreciation = "Passable";
    }
    else if($mark>=12 && $mark<14){
        $appreciation = "Assez bien";
    }
    else if($mark>=14 && $mark<=16){
        $appreciation = "Bien";
    }
    else if($mark>=16 && $mark<18){
        $appreciation = "Très bien";
    }
    else if($mark>=18 && $mark<=20){
        $appreciation = "Excellent";
    }else{
        $appreciation = "Votre note n'est pas valide";
    }
    return $appreciation;
}

//Coefficient des matières littéraires
$coef_litts = getElement($data_litt, 3);
$coef_litt = array_sum($coef_litts);
//Coefficient des matières scientifiques
$coef_scientifiques = getElement($data_scientifique, 3);
$coef_scientifique = array_sum($coef_scientifiques);
//Coefficient des matières complémentaires
$coef_complementaires = getElement($data_complementaire, 3);
$coef_complementaire = array_sum($coef_complementaires);

//notes des matières littéraires
$mark_litts = getElement($data_litt, 2);
$mark_litt = array_sum($mark_litts);
//notes des matières scientifiques
$mark_scientifiques = getElement($data_scientifique, 2);
$mark_scientifique = array_sum($mark_scientifiques);
//notes des matières complémentaires
$mark_complementaires = getElement($data_complementaire, 2);
$mark_complementaire = array_sum($mark_complementaires);

//total des notes coefficiés des matières littéraires
$total_litts = getElement($data_litt, 4);
$total_litt = array_sum($total_litts);
//total des notes coefficiés des matières scientifiques
$total_scientifiques = getElement($data_scientifique, 4);
$total_scientifique = array_sum($total_scientifiques);
//total des notes coefficiés des matières complémentaires
$total_complementaires = getElement($data_complementaire, 4);
$total_complementaire = array_sum($total_complementaires);


//Calcul des totaux
$total_coefs = sumElements(array($coef_litt, $coef_scientifique, $coef_complementaire));
$total_note_coef =  sumElements(array($total_litt, $total_scientifique, $total_complementaire));


//Calcul des moyennes
$moy_litt = $total_litt / $coef_litt;
$moy_scientifique = $total_scientifique / $coef_scientifique;
$moy_complementaire = $total_complementaire/ $coef_complementaire;
$moy = $total_note_coef / $total_coefs;

//die();
?>

<style type="text/css">
    .table-bordered {border-width: 0.25mm; border-style: solid; border-color: #000000;padding:1mm;}
	.content{font-size:4mm;}
    .cadre{display: inline; width: 40%; font-size: 3mm; text-align: center; position: relative;}
    .appreciation{font-size: 2.5mm; text-align: center;}
    .title{font-family: 'courier'; font-size: 8mm; font-weight: bold; text-align: center;}
    img{width: 100%;}
</style>
<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <div>
        <div class="cadre" style="text-align: left;">
            MINISTERE DES ENSEIGNEMENTS SECONDAIRES<br>
            <b>LYCEE D'EFOK</b> <br>
            BP.:1000 -Tél.:_________________________ Yaoundé <br>
            Yaoundé, le 05/06/2019
        </div>
        <div class="cadre" style="margin-left: 0.8%; margin-right: 0.8%; width: 17%;">
            <img src="./res/logo.png" alt="Logo de l'établissement">
        </div>
        <div class="cadre">
            <b>REPUBLIQUE DU CAMEROUN</b> <br>
            Paix-Travail-Patrie <br>
            <b>ANNEE SCOLAIRE 2019-2020</b>
        </div>
    </div>

    <br><br>
    <!-- Tableau contenant les informations: bulletin et le numéro de séquence  -->
    <table style="border-collapse: collapse; margin-left: 10%;">
        <col style="width: 65%;">
        <col style="width: 25%;">
        <tr>
            <td class="title">BULLETIN DE NOTES</td>
            <td><b>SEQUENCE 1</b></td>
        </tr>
    </table>

    <br>
    <!-- Tableau contenant les informations de l'élève  -->
    <table style="border-collapse: collapse; margin-left: 10%;">
        <col style="width: 65%;">
        <col style="width: 25%;">
        <tr>
            <td>Nom : <b>JOHN DOE Paul</b></td>
            <td>Classe : <b>2nde A4 ESP</b></td>
        </tr>
        <tr>
            <td>Né(e) le : 25/12/1900  à : YAOUNDE</td>
            <td>Effectif: 120</td>
        </tr>
        <tr>
            <td>Adresse : /</td>
            <td>situation : Non redoublante</td>
        </tr>
        <tr>
            <td>Enseignant titulaire</td>
        </tr>
    </table>

    <br>
    <!-- Tableau contenant les entetes -->
    <table style="border-collapse: collapse;">
        <col class="table-bordered content" style="width: 20%;">
        <col class="table-bordered content" style="width: 25%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 15%;">
        <tr>
            <th style="border: solid 1px black"><?= $header[0] ?></th>
            <th style="border: solid 1px black"><?= $header[1] ?></th>
			<th style="border: solid 1px black"><?= $header[2] ?></th>
            <th style="border: solid 1px black"><?= $header[3] ?></th>
            <th style="border: solid 1px black"><?= $header[4] ?></th>
            <th style="border: solid 1px black"><?= $header[5] ?></th>
            <th style="border: solid 1px black"><?= $header[6] ?></th>
        </tr>
    </table>

    <br>
    <!-- Tableau contenant les matières littéraires -->
    <table style="border-collapse: collapse;">
        <col class="table-bordered content" style="width: 20%;">
        <col class="table-bordered content" style="width: 25%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 15%;">
        <!-- Affichagee des lignes du tableau -->
        <?php foreach ($data_litt as $row): ?>
            <tr>
                <td><?= $row[0] ?></td>
                <td><?= $row[1] ?></td>
                <td><?= ($row[2]>=10) ? number_format($row[2],2,',',' ') : '<u>'.number_format($row[2],2,',',' ').'</u>' ?></td>
                <td><?= number_format($row[3],1,',',' ') ?></td>
                <td><?= number_format($row[4],2,',',' ') ?></td>
                <td><?= number_format($row[2],0,',',' ') ?></td>
                <td><?= $row[6] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="border-left: 0mm; border-bottom: 0mm;"><b>Total1-Matières Littéraires</b></td>
            <td><?= number_format($coef_litt,1,',',' ') ?></td>
            <td><b><?= number_format($total_litt,2,',',' ') ?></b></td>
            <td><b>Moyenne</b></td>
            <td><b><?= number_format($moy_litt,2,',',' ') ?></b></td>
        </tr>
    </table>

    <br>
    <!-- Tableau contenant les matières scientifiques -->
    <table style="border-collapse: collapse;">
        <col class="table-bordered content" style="width: 20%;">
        <col class="table-bordered content" style="width: 25%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 15%;">
        <!-- Affichagee des lignes du tableau -->
        <?php foreach ($data_scientifique as $row): ?>
            <tr>
                <td><?= $row[0] ?></td>
                <td><?= $row[1] ?></td>
                <td><?= ($row[2]>=10) ? number_format($row[2],2,',',' ') : '<u>'.number_format($row[2],2,',',' ').'</u>' ?></td>
                <td><?= number_format($row[3],1,',',' ') ?></td>
                <td><?= number_format($row[4],2,',',' ') ?></td>
                <td><?= number_format($row[2],0,',',' ') ?></td>
                <td><?= $row[6] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="border-left: 0mm; border-bottom: 0mm;"><b>Total2-Matières Scientifiques</b></td>
            <td><?= number_format($coef_scientifique,1,',',' ') ?></td>
            <td><b><?= number_format($total_scientifique,2,',',' ') ?></b></td>
            <td><b>Moyenne</b></td>
            <td><b><?= number_format($moy_scientifique,2,',',' ') ?></b></td>
        </tr>
    </table>

    <br>
    <!-- Tableau contenant les matières complémentaires -->
    <table style="border-collapse: collapse;">
        <col class="table-bordered content" style="width: 20%;">
        <col class="table-bordered content" style="width: 25%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 15%;">
        <!-- Affichagee des lignes du tableau -->
        <?php foreach ($data_complementaire as $row): ?>
            <tr>
                <td><?= $row[0] ?></td>
                <td><?= $row[1] ?></td>
                <td><?= ($row[2]>=10) ? number_format($row[2],2,',',' ') : '<u>'.number_format($row[2],2,',',' ').'</u>' ?></td>
                <td><?= number_format($row[3],1,',',' ') ?></td>
                <td><?= number_format($row[4],2,',',' ') ?></td>
                <td><?= number_format($row[2],0,',',' ') ?></td>
                <td><?= $row[6] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="border-left: 0mm; border-bottom: 0mm;"><b>Total3-Matières Complémentaires</b></td>
            <td><?= number_format($coef_complementaire,1,',',' ') ?></td>
            <td><b><?= number_format($total_complementaire,2,',',' ') ?></b></td>
            <td><b>Moyenne</b></td>
            <td><b><?= number_format($moy_complementaire,2,',',' ') ?></b></td>
        </tr>
    </table>

    <br>
    <!-- Tableau contenant la moyenne séquentielle  -->
    <table style="border-collapse: collapse;">
        <col class="table-bordered content" style="width: 20%;">
        <col class="table-bordered content" style="width: 25%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 10%;">
        <col class="table-bordered content" style="width: 15%;">
        <tr>
            <td colspan="3" style="border-left: 0mm; border-top:0mm; border-bottom: 0mm; text-align: center;"><b>MOYENNE SEQUENTIELLE</b></td>
            <td><?= number_format($total_coefs,1,',',' ') ?></td>
            <td><b><?= number_format($total_note_coef,2,',',' ') ?></b></td>
            <td><b><?= number_format($moy,2,',',' ') ?></b></td>
        </tr>
    </table>

    <br>
    <!-- Tableau contenant les appréciations  -->
    <table style="border-collapse: collapse;">
        <col class="table-bordered content" style="width: 15%;">
        <col class="table-bordered content" style="width: 15%;">
        <col class="table-bordered content" style="width: 15%;">
        <col class="table-bordered content" style="width: 25%;">
        <col class="table-bordered content" style="width: 30%;">
        <tr>
            <td  class="appreciation"><b>Total Abs.</b></td>
            <td class="appreciation"><b>Abs.N.J</b></td>
            <td class="appreciation"><b>Consignes</b></td>
            <td class="appreciation"><b>Conseil Discipline</b></td>
            <td class="appreciation"><b>Obserations</b></td>
        </tr>
        <tr>
            <td  class="appreciation"><b>0</b></td>
            <td class="appreciation"><b>0</b></td>
            <td class="appreciation"><b>0</b></td>
            <td class="appreciation"><b>/</b></td>
            <td rowspan="3" class="appreciation"><b>Travail Médiocre. Encore plus d'efforts</b></td>
        </tr>
        <tr>
            <td  class="appreciation"><b>Moy.Classe</b></td>
            <td class="appreciation"><b>Moy.Elève</b></td>
            <td class="appreciation"><b>Rang</b></td>
            <td class="appreciation"><b>Conseil classe</b></td>
        </tr>
        <tr>
            <td  class="appreciation"><b>10.51</b></td>
            <td class="appreciation"><b><?= number_format($moy,2,',',' ') ?></b></td>
            <td class="appreciation"><b>80ème</b></td>
            <td class="appreciation"><b>Médiocre</b></td>
        </tr>
        <tr>
            <td  class="appreciation">Faile Moy:<b>&nbsp; &nbsp; 7,23</b></td>
            <td class="appreciation">Nbre Moy 10:<b>&nbsp; &nbsp; 39</b></td>
            <td class="appreciation">Nbre Moy 8:<b>&nbsp; &nbsp; 3</b></td>
        </tr>
        <tr>
            <td class="appreciation">Forte Moy:<b>&nbsp; &nbsp; 7,23</b></td>
            <td class="appreciation">Nbre Moy 10:<b>&nbsp; &nbsp; 39</b></td>
            <td class="appreciation">Nbre Moy 8:<b>&nbsp; &nbsp; 3</b></td>
        </tr>
    </table>

    <br>
    <!-- Tableau contenant les visas et appréciations  -->
    <table style="border-collapse: collapse;">
        <col style="width: 25%;">
        <col style="width: 25%;">
        <col style="width: 25%;">
        <col style="width: 25%;">
        <tr>
            <th>Visa du Parent</th>
            <th>Visa du Surveillant Général</th>
            <th>Visa du Censeur</th>
            <th>Visa du Proviseur</th>
        </tr>
    </table>



    <page_footer>
        <div style="font-size: 2.5mm;">
        <b>NB:</b> Ce bulletin remis à l'élève , doit être rendu aux parents ou aux personnes mandatées qui prennent connaissance des noteset observations qu'il renferme.
        <hr>
        <b>NB: 15 jours après la remise des bulletins, aucune réclamation ne sera acceptée.</b>
        </div>
    </page_footer>

</page>