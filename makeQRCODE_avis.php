<pre><?php
require_once 'config.ini';
include('vendor/phpqrcode/qrlib.php');


QRcode::png('https://bourseaux1000velos.avs44.com/index.php?page=avis.php','./out/QRCODE_AVIS.png',QR_ECLEVEL_L, 3);
echo "<table width=100% ><tr ><td width=50% style='text-align:center'>";
echo "<h1>Laissez nous votre avis sur<br/>la Bourse aux 1000 vélos</h1>";
echo "<img src='./out/QRCODE_AVIS.png' width=400px /><br/> ";
echo "<img src='https://bourseaux1000velos.avs44.com/Images/BAV_2020.png' width=400px />";
echo "</td><td width=50%  style='text-align:center'>";
echo "<h1>Laissez nous votre avis sur<br/>la Bourse aux 1000 vélos</h1>";
echo "<img src='./out/QRCODE_AVIS.png' width=400px /><br/> ";
echo "<img src='https://bourseaux1000velos.avs44.com/Images/BAV_2020.png' width=400px />";
echo "</td><tr></table>";

// echo "<hr/>";
// QRcode::png('https://http://127.0.0.1/edsa-BAV/Actions/rest.php?a=P','./out/QRCODE_CAFFARD2.png',QR_ECLEVEL_L, 3);
// echo "<img src='./out/QRCODE_CAFFARD2.png' />";
// echo "<h1>QRCODE accès BAV vendeur sur 127.0.0.1</h1>";
echo "<div style='page-break-after:always; clear:both;font-size:10pt;height:10pt'><hr/></div>";
// echo "<hr/>";
// QRcode::png('https:/.localhost/bourseauxvelos/Actions/rest.php?a=P','./out/QRCODE_CAFFARD3.png',QR_ECLEVEL_L, 3);
// echo "<img src='./out/QRCODE_CAFFARD3.png' />";
// echo "<h1>QRCODE accès BAV vendeur sur localhost</h1>";
QRcode::png('https://bourseaux1000velos.avs44.com/index.php?page=stock-client.php','./out/QRCODE_VELOS.png',QR_ECLEVEL_L, 3);

echo "<table width=100% ><tr ><td width=50% style='text-align:center'>";
echo "<h1>Scannez ce QRCODE pour accéder à la liste des tous les vélos disponibles.</h1>";
echo "<img src='./out/QRCODE_VELOS.png' width=400px /><br/> ";
echo "<img src='https://bourseaux1000velos.avs44.com/Images/BAV_2020.png' width=400px />";
echo "</td><td width=50%  style='text-align:center'>";

echo "<h1>Scannez ce QRCODE pour accéder à la liste des tous les vélos disponibles.</h1>";
echo "<img src='./out/QRCODE_VELOS.png' width=400px /><br/> ";
echo "<img src='https://bourseaux1000velos.avs44.com/Images/BAV_2020.png' width=400px />";
echo "</td><tr></table>";
