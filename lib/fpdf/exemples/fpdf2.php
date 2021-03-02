<?php
$bdd=new PDO('mysql: host=localhost;dbname=exposer','root','');

            $id=0;
    $reponce=$bdd->query('SELECT ID FROM exposer ');
     while ($donnee=$reponce->fetch()) 
        {
          $id=$id+1;//recuperation de lID DU DERNIER ENREGISTREMENT
        }
                                  


                            
                         

     $reponce=$bdd->prepare('SELECT * FROM exposer WHERE ID=?');
    $reponce->execute(array($id));
    while ($donnee=$reponce->fetch()) 
    {
     $mat=$donnee['MATRICULE'];
     $nom=$donnee['NOM'];
     $prenom=$donnee['PRENOM'];
     $age=$donnee['AGE'];
     $sexe=$donnee['SEXE'];
     $lieux=$donnee['LIEUXNAISSANCE'];
     $email=$donnee['EMAIL'];
    }                       
     
     require('fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',30);
    $pdf->Cell(0,20,'Inscription Reussi',1,2,'C');
    $pdf->Ln();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(80,10,'Nom :',1,0,'');
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(90,10,$nom.'   ',1,1,'C');
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(80,10,'PreNom :',1,0,'');
    $pdf->Cell(90,10,$prenom.'   ',1,1,'C');
    $pdf->Ln();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(80,10,'Age :',1,0,'');
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(90,10,$age.'  ans',1,1,'C');
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(80,10,'Sexe :',1,0,'');
    $pdf->Cell(90,10,$sexe.'   ',1,1,'C');
    $pdf->Ln();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(80,10,'MATRICULE :',1,0,'');
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(90,10,$mat.'   ',1,1,'C');
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(80,10,'LIEUX DE NAISSANCE :',1,0,'');
    $pdf->Cell(90,10,$lieux,1,1,'C');
     $pdf->Cell(80,10,'EMAIL :',1,0,'');
    $pdf->Cell(90,10,$email,1,1,'C');
    $pdf->Ln();

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    
    $pdf->MultiCell(0,10,'En cas de perte bien vouloir contacter l \'un des numeros suivant
        *695664322
        *655953062',0);
     $pdf->Ln();
     $pdf->Cell(0,20,'SIGNATURE :',1,1,'');
     $pdf->Cell(0,20,'Fait a yaoundee le                                        a                               ',0,0,'');




    
  
    $pdf->Output();
                   

?>





