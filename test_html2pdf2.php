<?
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
//$html2pdf->writeHTML('<img alt="tasse de café" height="53" src="https://unetache.fr/wp-content/uploads/2019/02/tachecafe7.png" width="53" />');
$html2pdf->writeHTML('<img alt="tasse de café" height="53" src="Images/sel.gif" width="53" />');
$html2pdf->writeHTML('<img alt="tasse de café" height="53" src="Images/arobase.png" width="53" />');

$html2pdf->output();
?>