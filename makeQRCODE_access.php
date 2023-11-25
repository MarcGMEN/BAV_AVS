<pre><?php
require_once 'config.ini';
include('vendor/phpqrcode/qrlib.php');

QRcode::png('https://bourseaux1000velos.avs44.com/Actions/rest.php?a=P','./out/QRCODE_CAFFARD.png',QR_ECLEVEL_L, 3);
echo "<img src='./out/QRCODE_CAFFARD1.png' />";
echo "<h1>QRCODE accès BAV vendeur</h1>";


echo "<hr/>";
QRcode::png('https://http://127.0.0.1/edsa-BAV/Actions/rest.php?a=P','./out/QRCODE_CAFFARD.png',QR_ECLEVEL_L, 3);
echo "<img src='./out/QRCODE_CAFFARD2.png' />";
echo "<h1>QRCODE accès BAV vendeur sur 127.0.0.1</h1>";

echo "<hr/>";
QRcode::png('https:/.localhost/bourseauxvelos/Actions/rest.php?a=P','./out/QRCODE_CAFFARD.png',QR_ECLEVEL_L, 3);
echo "<img src='./out/QRCODE_CAFFARD3.png' />";
echo "<h1>QRCODE accès BAV vendeur sur 127.0.0.1</h1>";

