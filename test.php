<pre>
<?
 //echo "fiche 64"."<br/>";
 $fiche=64;
//  echo dechex(64)."<br/>";   
//  echo decoct(64)."<br/>";   
//  echo decbin(64)."<br/>";   
//  echo base_convert(64, 16, 6)."<br/>"; 
//  echo crypt($fiche)."<br/>";   
//echo substr(hash_hmac('md5', rand(0,1000), 'avs44'),0,5)."<br/>";


require_once "Commun/connect.php";
require_once "config.ini";
require_once "Commun/commun_functions.php";
require_once "Commun/mail.php";

echo "test.php";
echo sendMail("test PJ", "braillou@gmail.com", "piece jointe", "/BAV/out/PDF/Fiche_710.pdf");
//echo sendMail("test ", "braillou@gmail.com", "sans piece jointe", null);
//print_r($mysqli);
//echo substr(hash_hmac('md5', 700, 'avs442019'), 0, 5);;
?>
</pre>
