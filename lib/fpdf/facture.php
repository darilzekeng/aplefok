<?php
require('fpdf.php');
$infos_pers[1]=$_POST['matricule'];
$infos_pers[2]=$_POST['nom'];
$infos_pers[3]=$_POST['prenoms'];
$infos_pers[4]=$_POST['date_naiss'];
$infos_pers[5]=$_POST['lieu_naiss'];
$infos_pers[6]=$_POST['poste'];
$infos_pers[7]=$_POST['parcours'];
$infos_pers[8]=$_POST['famille'];
$infos_pers[9]=$_POST['diplome'];
$infos_pers[10]=$_POST['cni'];
$infos_pers[11]=$_POST['genre'];

$donnees_pers[1]='matricule';
$donnees_pers[2]='nom';
$donnees_pers[3]='prenoms';
$donnees_pers[4]='date de naissance';
$donnees_pers[5]='lieu de naissance';
$donnees_pers[6]='fonction actuel';
$donnees_pers[7]='parcours entreprise' ;
$donnees_pers[8]='situation familiale';
$donnees_pers[9]='diplome de qualification';
$donnees_pers[10]='numero de CNI';
$donnees_pers[11]='Genre';

class PDF extends FPDF
{
function Header()
{
    global $titre;

    // Arial gras 15
    $this->SetFont('times','B',22);
    // Calcul de la largeur du titre et positionnement
    $w = $this->GetStringWidth($titre)+6;
    $this->SetX((210-$w)/2);
    // Couleurs du cadre, du fond et du texte
    $this->SetDrawColor(65,165,54);
    $this->SetFillColor(65,165,54);
    $this->SetTextColor(255,255,255);
    // Epaisseur du cadre (1 mm)
    $this->SetLineWidth(0);
    // Titre
    $this->Cell($w,15,$titre,1,1,'C',true);
    // Saut de ligne
    $this->Ln(10);
}

function cadre($titre)
{
    // Arial gras 15
    $this->SetFont('times','B',22);
    // Calcul de la largeur du titre et positionnement
    $w = $this->GetStringWidth($titre)+6;
    $this->SetX((210-$w)/2);
    // Couleurs du cadre, du fond et du texte
    $this->SetDrawColor(65,165,54);
    $this->SetFillColor(65,165,54);
    $this->SetTextColor(255,255,255);
    // Epaisseur du cadre (1 mm)
    $this->SetLineWidth(0);
    // Titre
    $this->Cell($w,15,$titre,1,1,'C',true);
    // Saut de ligne
    $this->Ln(10);
}
	
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{
    // Parseur HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Texte
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Balise
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraction des attributs
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Balise ouvrante
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Balise fermante
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modifie le style et sélectionne la police correspondante
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Place un hyperlien
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

// Chargement des données
function LoadData($file)
{
    // Lecture des lignes du fichier
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Tableau coloré
function FancyTable($header, $data)
{
    // Couleurs, épaisseur du trait et police grasse
    $this->SetFillColor(65,165,54);
    $this->SetTextColor(255);
    $this->SetDrawColor(65,165,54);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // En-tête
    $w = array(25, 35, 50, 70);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauration des couleurs et de la police
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Données
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2],0,',',' '),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Trait de terminaison
    $this->Cell(array_sum($w),0,'','T');
	
	//Prix total
	$this->Ln(3);
	$this->SetDrawColor(65,165,54);
	$this->SetFillColor(65,165,54);
	$this->SetTextColor(255,255,255);
	$this->Cell($w[0],6,' ','R',0,'R',!$fill);
	$this->Cell($w[1],6,' ','R',0,'R',!$fill);
	$this->Cell($w[2],6,'Total de la facture','R',0,'L',$fill);
	$this->Cell($w[3],6,'10000 Fcfa','R',0,'L',$fill);
	
	//Ligne de séparation
	$this->Ln(40);
	$this->Cell(160,0.5,'',1,1,'C',true);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-60);
    // Police Arial italique 8
    $this->SetFont('Arial','I',12);
	$this->SetTextColor(65,165,54);
    // Numéro de page
    $this->Cell(0,10,utf8_decode('Conditions et modalités de paiement'),0,0,'L');
	$this->Ln(5);
	$this->SetFont('Arial','I',8);
	$this->SetTextColor(0);
	$this->Cell(0,10,utf8_decode('Paiement éffectué dans les 15 jours'),0,0,'L');
	$this->Ln(7);
	$this->Cell(0,10,'Cbank NA',0,0,'L');
	$this->Ln(3);
	$this->Cell(0,10,'Compte: 123456',0,0,'L');
	$this->Ln(3);
	$this->Cell(0,10,'Routing: 2345',0,0,'L');
	$this->Ln(3);
}

}

$pdf = new PDF();
$titre = 'AMONDA Inc                                                            ';
$pdf->AddPage();
$pdf->Image('img.jpg',130,25,63,16);
$pdf->SetAuthor('AMONDA ZTD ');
$pdf->SetCreator('by FPDF 1.8.1');
$pdf->SetFont('Arial','B',12);
$pdf->SetTitle($titre);


$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode('405 Avenue des banques'),0,0,'L');
$pdf->Ln(5);
$pdf->Cell(0,10,utf8_decode('Yaoundé Cameroun'),0,0,'L');
	
$pdf->Ln(40);

//
$pdf->Cell(43,10,utf8_decode('Facturer à'),0,0,'L');
$pdf->Cell(43,10,utf8_decode('Envoyer à'),0,0,'L');
$pdf->Cell(43,10,utf8_decode('Facture N0'),0,0,'L');
$pdf->Cell(43,10, utf8_decode('AMD01'),0,1,'L');
//
$pdf->Cell(43,10,utf8_decode('Facturer à'),0,0,'L');
$pdf->Cell(43,10,utf8_decode('Envoyer à'),0,0,'L');
$pdf->Cell(43,10,utf8_decode('Facture N0'),0,0,'L');
$pdf->Cell(43,10, utf8_decode('AMD01'),0,1,'L');
$pdf->Ln(10);

// Titres des colonnes
$header = array(utf8_decode('Quantité'), utf8_decode('Désignation'), 'Prix unit HT', 'Montant HT');
// Chargement des données
$data = $pdf->LoadData('facture.txt');
$pdf->SetFont('Arial','',14);
//$pdf->AddPage();
$pdf->FancyTable($header,$data);
	
$pdf->Output('FACTURE_'.$infos_pers[1].'_'.$infos_pers[2].'.pdf');
//$pdf->Close();
//$pdf->Output('facture1.pdf','I');
?>