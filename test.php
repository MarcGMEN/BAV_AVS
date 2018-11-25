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
require_once "Repository/base_repository.php";
require_once "Repository/parametre_repository.php";
require_once "Commun/connect.php";
require_once "AJAX/parametre_AJAX.php";

if (!isset($_COOKIE['NUMERO_BAV'])) {
	setcookie('NUMERO_BAV', date('Y'), time() + (86400 * 30), "/"); // 86400 = 1 day
	$_COOKIE['NUMERO_BAV']=date('Y');
}
print_r($mysqli);
print_r(getEnumValues('objet','obj_public'));
?>
<script src="JS/cookies.js" type="text/javascript"></script>
<script>
    SetCookie('CONNEX_BAV', null);
</script>
</pre>
