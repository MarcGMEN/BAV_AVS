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
//print_r($_SERVER);
require_once "Commun/commun_functions.php";
echo "OK Commun/commun_functions.php";
echo "<br/>";
require_once "Commun/connect.php";
echo "OK Commun/connect.php";
echo "<br/>";

require_once "AJAX/parametre_AJAX.php";
echo "OK AJAX/parametre_AJAX.php.php";
echo "<br/>";
print_r($mysqli);
$row = return_oneParametre('2019');
print_r($row);
?>
</pre>
