<?php
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
require_once("html2pdf/src/Html2Pdf.php");
$html2pdf = new Html2Pdf('P','A4','de',true,"UTF-8",array(10, 10, 10, 16));
$buffer = "<h1>Text</h1>";
$html2pdf->writeHTML($buffer);
//$html2pdf->output('test.pdf');
$html2pdf->output();
?>