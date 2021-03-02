 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>FORMULAIRE</title>
<link type="text/css" rel="stylesheet" href="fpdf.css">
<style type="text/css">
dd {margin:1em 0 1em 1em}
</style>
</head>
<body>
 
 <FORM action="facture.php" method="post">
    <P>
    Matricule 	: <INPUT type="text" name="matricule"><BR>
    Nom 	: <INPUT type="text" name="nom"><BR>
    Prenom: <INPUT type="text" name="prenoms"><BR>
	Date de naissance [JJ-MM-AAAA]: <INPUT type="text" name="date_naiss"><BR>
	Lieu de naissance: <INPUT type="text" name="lieu_naiss"><BR>
	Poste actuel	: <INPUT type="text" name="poste"><BR>
	Parcours entreprise	: <INPUT type="text" name="parcours"><BR>
	situation familiale	: <INPUT type="text" name="famille"><BR>
	diplome de qualification: <INPUT type="text" name="diplome"><BR>
	numero de CNI: <INPUT type="text" name="cni"><BR>
    <P>Sexe</P><INPUT type="radio" name="genre" value="homme"> Homme<BR>
    <INPUT type="radio" name="genre" value="femme"> Femme<BR>
    <INPUT type="submit" value="Envoyer"> <INPUT type="reset">
	
	
	
    </P>
 </FORM>
