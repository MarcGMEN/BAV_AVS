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
require_once "Repository/base_repository.php";
require_once "Repository/parametre_repository.php";
require_once "Repository/fiche_repository.php";
require_once "AJAX/parametre_AJAX.php";
require_once "AJAX/fiche_AJAX.php";
echo "test.php";
//print_r($mysqli);
echo substr(hash_hmac('md5', 700, 'avs442019'), 0, 5);
//print_r(return_list_marques());
?>
</pre>
