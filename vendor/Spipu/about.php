<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */

 use Spipu\Html2Pdf\Html2Pdf;
 use Spipu\Html2Pdf\Exception\Html2PdfException;
 use Spipu\Html2Pdf\Exception\ExceptionFormatter;
 //require_once("../src/Html2Pdf.php");
 require_once("html2pdf/src/Html2Pdf.php");

try {
    //$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
	$html2pdf = new Html2Pdf('P','A4','de',true,"UTF-8",array(10, 10, 10, 16));
    $html2pdf->pdf->SetDisplayMode('fullpage');

    ob_start();
    //include dirname(__FILE__).'/res/about.php';
	include dirname(__FILE__).'html2pdf/examples/res/about.php';
    $content = ob_get_clean();

    $html2pdf->writeHTML($content);
    $html2pdf->createIndex('Sommaire', 30, 12, false, true, 2, null, '10mm');
    $html2pdf->output('about.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
