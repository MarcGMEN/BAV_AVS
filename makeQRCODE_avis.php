<pre><?php
require_once 'config.ini';
include('vendor/phpqrcode/qrlib.php');

QRcode::png('https://bourseaux1000velos.avs44.com/index.php?page=avis.php','./out/QRCODE_AVIS.png',QR_ECLEVEL_L, 3);
echo "<h1>Laissez nous votre avis sur<br/>la Bourse aux 1000 vélos</h1>";

echo "<img src='./out/QRCODE_AVIS.png' width=400px /><br/> ";
echo "<img src='https://bourseaux1000velos.avs44.com/Images/BAV_2020.png' width=400px />";
// echo "<hr/>";
// QRcode::png('https://http://127.0.0.1/edsa-BAV/Actions/rest.php?a=P','./out/QRCODE_CAFFARD2.png',QR_ECLEVEL_L, 3);
// echo "<img src='./out/QRCODE_CAFFARD2.png' />";
// echo "<h1>QRCODE accès BAV vendeur sur 127.0.0.1</h1>";

// echo "<hr/>";
// QRcode::png('https:/.localhost/bourseauxvelos/Actions/rest.php?a=P','./out/QRCODE_CAFFARD3.png',QR_ECLEVEL_L, 3);
// echo "<img src='./out/QRCODE_CAFFARD3.png' />";
// echo "<h1>QRCODE accès BAV vendeur sur localhost</h1>";

