<?php
/**
 * modèle pour la création des fichiers pdf
 *
 * @author    Daril ZEKENG <darilzekeng48@gmail.com>
 * @copyright 2019 Daril ZEKENG
 */
 use Spipu\Html2Pdf\Html2Pdf;
 use Spipu\Html2Pdf\Exception\Html2PdfException;
 use Spipu\Html2Pdf\Exception\ExceptionFormatter;
 
 //require_once("../vendor/Spipu/html2pdf/src/Html2Pdf.php");
 require_once(dirname(dirname(__FILE__)).'/vendor/Spipu/html2pdf/src/Html2Pdf.php');

 //Vérification du type de fichier a imprimer 
 if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $filename = $type.'.php';
    $file_dir = 'res/'.$filename;
    //si un fichier correspondant au paramètre n'existe pas, il y a erreur
    if (!file_exists($file_dir)) {
        echo '<h1 style="color:red;">Le fichier que vous souhaitez imprimer est invalide</h1>';
        exit();
    }
 }else{
    echo '<h1 style="color:red;">Le fichier que vous souhaitez imprimer est invalide</h1>';
    exit();
 }

try {
    ob_start();
    include dirname(__FILE__).'/res/'.$filename; //include dirname(__FILE__).'/res/students_list.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setTestIsImage(false);
    $html2pdf->setFallbackImage('./res/off.png');
    $html2pdf->writeHTML($content);
    $html2pdf->output($type.'.pdf'); //$html2pdf->output('example14.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
