<?php
require("../../_header.php");
?>

<?php
$ids = array_keys($_SESSION['panier']);
 //unset($ids[0]);
//print_r($ids);

if (empty($ids)) {
  $produit = array();
}
else{
  $produit = $DB->query('SELECT * FROM produit WHERE id_produit IN ('.implode(' , ',$ids).')');
  //$produit = $DB->query('SELECT * FROM produit WHERE id_produit IN (1, 2)');  
}

$data ="";
foreach ($produit as $produit1) {
	$data = $data.$_SESSION['panier'][$produit1->id_produit].';'.$produit1->nom_produit.';'.$produit1->prix_produit.';'.$produit1->prix_produit * $_SESSION['panier'][$produit1->id_produit]."\n";
}

echo $data;
$fichier = fopen("facture.txt", "r+");
fseek($fichier, 0); // On remet le curseur au début du fichier
fputs($fichier, html_entity_decode($data));
fclose($fichier);
?>