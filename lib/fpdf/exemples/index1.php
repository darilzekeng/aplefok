
	<?php
		require('fpdf.php');
		$pdf=new FPDF();
		
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'Hello World !',1,2,'C');
		$pdf->Output();
        		
	?>


