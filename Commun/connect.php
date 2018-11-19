<?
//require "SO_Post_Get.php";

session_start();

if (isset($_GET)) {
	extract($_GET,EXTR_PREFIX_ALL,'GET');
}
if (isset($_POST)) {
	extract($_POST,EXTR_PREFIX_ALL,'GET');
}
if (isset($_COOKIE)) {
	extract($_COOKIE,EXTR_PREFIX_ALL,'COOKIE');
}
if (isset($_FILES)) {
	extract($_FILES,EXTR_PREFIX_ALL,'FILE');
}

echo "debut connect";
error_reporting(E_ALL);
error_reporting(-1);
// en local
$id_db = mysql_connect("localhost", "bav", "AVS44BAV1200");
mysql_select_db("bav");
print_r("mysql_connect $id_db");
print_r(error_get_last());
$id_db = new Mysqli('localhost','bav','AVS44BAV1200' , 'bav');
print_r("new mysqli $id_db");
print_r(error_get_last());


// en prod
//$id_db = mysql_connect('localhost','romael.website','romael' );
//mysql_select_db('romael_website');


/*********************************************************************************/
/*********************************************************************************/
/*********************************************************************************/
/*********************************************************************************/
/*********************************************************************************/
/*********************************************************************************/
function backup($dbhost,$dbuser,$dbpass,$dbname,$force=false,$repBase="") {

	require_once($repBase.'Commun/mysqldump.class.php'); //Location Of Class File.

	$drop_table_if_exists = false; //Add MySQL 'DROP TABLE IF EXISTS' Statement To Output?
	$version2 = '1.1.2'; //Script Version.

	// sauvegarde journaliere
	$dateToday = date("Ymd");
	$nameBackup=$repBase."backup/".$dbname."_".date("Ymd").".sql.zip";
	if (!file_exists($nameBackup) || $force) {
		// recherche avec .sql
		$nameBackup=$repBase."backup/".$dbname."_".date("Ymd").".sql";
		if (!file_exists($nameBackup) || $force) {
			// connection OK
			if (!is_dir($repBase."backup")) {
				if (!mkdir($repBase."backup",0777,true)) {
					print_r(error_get_last());
					echo "errror creation  backup";
				}
			}

			$writer="";

			$backup = new MySQLDump();
			$backup->droptableifexists = $drop_table_if_exists;
			$backup->connect($dbhost,$dbuser,$dbpass,$dbname); //Connect To Database
			if (!$backup->connected) { die('Error: '.$backup->mysql_error); } //On Failed Connection, Show Error.
			$backup->list_tables(); //List Database Tables.
			$broj = count($backup->tables); //Count Database Tables.

			for ($i=0;$i<$broj;$i++) {
				$table_name = $backup->tables[$i]; //Get Table Names.
				$backup->dump_table($table_name); //Dump Data to the Output Buffer.
				$writer.=$backup->output;
			}
			file_put_contents($nameBackup, $writer);

			if (phpVersionDouble() >= 5.2) {
				$zip =new ZipArchive();
				if ($zip->open($nameBackup.".zip",ZIPARCHIVE::OVERWRITE) === TRUE) {
					$zip->addFile($nameBackup, basename($nameBackup));
					$zip->close();
					unlink($nameBackup);
				}
				else {
					print_r(error_get_last());
				}
			}
		}
	}
}

function recupEnumToArray($table, $champ) {
	$query_EnumList = "DESCRIBE $table '$champ'";
	$EnumList = mysql_query($query_EnumList) or die(mysql_error());
	$row_EnumList = mysql_fetch_assoc($EnumList);
	
	$str = preg_replace("[enum\(]",'',$row_EnumList['Type']);
	$str1 = preg_replace("[\)]",'',$str);
	$str = preg_replace("[\']",'',$str1);
	return preg_split("[,]",$str);
}

function recupValToArray($table, $champ, $search) {
	$tabRet=array();
	$index=1;
	$query_EnumList = "SELECT '$champ' from $table where $champ like '%$search%' group by $champ order by $champ ";
	$EnumList = mysql_query($query_EnumList) or die(mysql_error());
	while ($row_EnumList = mysql_fetch_assoc($EnumList)) {
		$tabRet[$index++]=$row_EnumList[$champ];
	}
	return $tabRet;
}

/**
 * This function extracts the non-tags string and returns a correctly formatted string
 * It can handle all html entities e.g. &amp;, &quot;, etc..
 *
 * @param string $s
 * @param integer $srt
 * @param integer $len
 * @param bool/integer	Strict if this is defined, then the last word will be complete. If this is set to 2 then the last sentence will be completed.
 * @param string A string to suffix the value, only if it has been chopped.
 */
function html_substr( $s, $srt, $len = NULL, $strict=false, $suffix = NULL )
{
	if ( is_null($len) ){ $len = strlen( $s ); }

	$f = 'static $strlen=0;
			if ( $strlen >= ' . $len . ' ) { return "><"; } 
			$html_str = html_entity_decode( $a[1] );
			$subsrt   = max(0, ('.$srt.'-$strlen));
			$sublen = ' . ( empty($strict)? '(' . $len . '-$strlen)' : 'max(@strpos( $html_str, "' . ($strict===2?'.':' ') . '", (' . $len . ' - $strlen + $subsrt - 1 )), ' . $len . ' - $strlen)' ) . ';
			$new_str = substr( $html_str, $subsrt,$sublen); 
			$strlen += $new_str_len = strlen( $new_str );
			$suffix = ' . (!empty( $suffix ) ? '($new_str_len===$sublen?"'.$suffix.'":"")' : '""' ) . ';
			return ">" . htmlentities($new_str, ENT_QUOTES, "UTF-8") . "$suffix<";';

	return preg_replace( array( "#<[^/][^>]+>(?R)*</[^>]+>#", "#(<(b|h)r\s?/?>){2,}$#is"), "", trim( rtrim( ltrim( preg_replace_callback( "#>([^<]+)<#", create_function(
            '$a',	$f	), ">$s<"  ), ">"), "<" ) ) );
}


?>
