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
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    // Epaisseur du cadre (1 mm)
    $this->SetLineWidth(1);
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
}

$pdf = new PDF();
$titre = 'FICHIER  D\' INFORMATIONS DU PERSONNEL';
$pdf->AddPage();
$pdf->Image('img.png',40,30,40);
$pdf->SetAuthor('IN204 : GROUPE 10-11 ');
$pdf->SetCreator('by FPDF 1.8.1');
$pdf->SetFont('Arial','BU',14);
$pdf->SetTitle($titre);
	$marge_p=25;
	$nb_infos=10;
	$pdf->SetMargins(15,30);
	$pdf->Ln(10);
	$matricule=$donnees_pers[1].' '.$infos_pers[1];
	$pdf->MultiCell(175,13,$matricule,0,'R');
	$pdf->Ln(15);
	for($i=2;$i<$nb_infos+1;$i++){
		$html = '<b><u>'.$donnees_pers[$i].'</u></b> : '.$infos_pers[$i].'<br>';
		$pdf->WriteHTML($html);
		$pdf->Ln(10);}
$pdf->Output('FICHE_EMPLOYE_'.$infos_pers[1].'_'.$infos_pers[2].'.pdf');
?>