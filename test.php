<pre>
<?php
 //echo "fiche 64"."<br/>";
 $fiche = 64;
//  echo dechex(64)."<br/>";
//  echo decoct(64)."<br/>";
//  echo decbin(64)."<br/>";
//  echo base_convert(64, 16, 6)."<br/>";
//  echo crypt($fiche)."<br/>";
//setcookie('AADD', '1') or die('unable to create cookie');

//setcookie('NUMERO_BAV_BIS', date('Y'), time() + (86400 * 30), '/') or die('unable to create cookie');

require_once 'Commun/connect.php';
require_once 'config.ini';
require_once 'Commun/commun_functions.php';
require_once 'Commun/mail.php';

// echo "test.php";
// echo sendMail("test PJ", "braillou@gmail.com", "piece jointe", "/BAV/out/PDF/Fiche_710.pdf");
//echo sendMail('test ', 'braillou@gmmmmail.com', 'sans piece jointe', null);
//print_r($mysqli);
//echo substr(hash_hmac('md5', 700, 'avs442019'), 0, 5);;

$random = rand($base, $base+2000);
//echo password_hash("BAV2019", PASSWORD_DEFAULT);
echo "412 2021 random => <br/>".hash_hmac('md5', "412"."2021".$random, 'avs44'.$_COOKIE['NUMERO_BAV']);
echo "<br/>";

echo "577 => <br/>".hash_hmac('md5', "577".$_COOKIE['NUMERO_BAV'], 'avs44');
//echo password_verify('BAV2019', $GLOBALS['PASS_TABLE']);
?>
</pre>
