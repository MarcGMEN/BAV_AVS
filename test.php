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
echo "OK ommun/connect.php";
echo "<br/>";

echo "mysql_connect('localhost','bav','AVS44BAV1200' );";

$id_db = mysql_connect('localhost', 'bav', 'AVS44BAV1200') or die("Unable to Connect");
print_($id_db);
print_r(error_get_last());
echo "ici1";
mysql_select_db('bav');
print_r(error_get_last());
echo "ici2";

print_($id_db);

?>
</pre>
