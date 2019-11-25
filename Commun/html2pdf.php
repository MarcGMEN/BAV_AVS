<?php
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

function html2pdf($data, $html, $fileOut, $format="P")
{
    try {
        $message = makeCorps($data, $html);
        extract($GLOBALS);
        file_put_contents(dirname(__FILE__)."/../out/html/$fileOut.html", stripslashes($message));
        ob_start();
        echo "<page backtop='5mm' backleft='5mm' backright='5mm' backbottom='5mm'>";
        include dirname(__FILE__)."/../out/html/$fileOut.html";
        echo "</page>";
        $content = ob_get_clean();
        $html2pdf = new Html2Pdf($format, 'A4', 'fr', true, 'UTF-8', 3);
        //$html2pdf->setDefaultFont('Arial');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->pdf->SetAuthor('AVS44');
        $html2pdf->writeHTML($content);
        $html2pdf->output(dirname(__FILE__)."/../out/PDF/$fileOut.pdf", 'F');
    } catch (Html2PdfException $e) {
        $html2pdf->clean();
        $formatter = new ExceptionFormatter($e);
        print_r($message);
        print_r($formatter);
        throw $formatter;
    }
    return $CFG_OUT_PDF.$fileOut.".pdf";
}
