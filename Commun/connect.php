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

if ($_SERVER['SERVER_NAME'] == "avs44.com") {

	$mysqli = mysqli_connect('db2463.1and1.fr','dbo326893785','randovtt' , 'db326893785');
}
else {
	$mysqli = mysqli_connect('localhost','bav','AVS44b@v!' , 'BAV');
}

if (mysqli_connect_errno($mysqli)) {
	print_r($mysqli);
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

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
