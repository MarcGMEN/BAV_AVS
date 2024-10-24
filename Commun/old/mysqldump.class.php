<?php
/*
* Database MySQLDump Class File
* Copyright (c) 2009 by James Elliott
* James.d.Elliott@gmail.com
* GNU General Public License v3 http://www.gnu.org/licenses/gpl.html
*/

$version1 = '1.3.2'; //This Scripts Version.

class MySQLDump {
	var $tables = array();
	var $connected = false;
	var $output;
	var $droptableifexists = false;
	var $mysql_error;
	
function connect($host,$user,$pass,$db) {	
	$return = true;
	$conn = @mysql_connect($host,$user,$pass);
	if (!$conn) { $this->mysql_error = mysql_error(); $return = false; }
	$seldb = @mysql_select_db($db);
	if (!$conn) { $this->mysql_error = mysql_error();  $return = false; }
	$this->connected = $return;
	return $return;
}

function list_tables() {
	$return = true;
	if (!$this->connected) { $return = false; }
	$this->tables = array();
	$sql = mysql_query("SHOW TABLES");
	while ($row = mysql_fetch_array($sql)) {
		array_push($this->tables,$row[0]);
	}
	return $return;
}

function list_values($tablename) {
	$sql = mysql_query("SELECT * FROM $tablename");
	$this->output .= "\n\n-- Dumping data for table: $tablename\n\n";
	while ($row = mysql_fetch_array($sql)) {
		$broj_polja = count($row) / 2;
		$this->output .= "INSERT INTO `$tablename` VALUES(";
		$buffer = '';
		for ($i=0;$i < $broj_polja;$i++) {
			$vrednost = $row[$i];
			if (!is_integer($vrednost)) { $vrednost = "'".addslashes($vrednost)."'"; } 
			$buffer .= $vrednost.', ';
		}
		$buffer = substr($buffer,0,count($buffer)-3);
		$this->output .= $buffer . ");\n";
	}	
}

function dump_table($tablename) {
	$this->output = "";
	$this->get_table_structure($tablename);	
	$this->list_values($tablename);
}

function get_table_structure($tablename) {
	$this->output .= "\n\n-- Dumping structure for table: $tablename\n\n";
	if ($this->droptableifexists) { $this->output .= "DROP TABLE IF EXISTS `$tablename`;\nCREATE TABLE `$tablename` (\n"; }
		else { $this->output .= "CREATE TABLE `$tablename` (\n"; }
	$sql = mysql_query("DESCRIBE $tablename");
	$this->fields = array();
	$primary="";
	$ukey=0;
    $uniqueKey = array();
		
	while ($row = mysql_fetch_array($sql)) {
	    //print_r($row);
		$name = $row[0];
		$type = $row[1];
		$null = $row[2];
		if (empty($null)) { $null = "NOT NULL"; }
		$key = $row[3];
		if ($key == "PRI") {
		    if ($primary || sizeof($uniqueKey) > 0) {
		      // clef unique sur deux champ
		      $uniqueKey[$ukey++]=$primary;
		      $uniqueKey[$ukey++]=$primary;
		      $primary="";
		    } 
		    else {
		      $primary = $name; 
		    }
		    
	    }
		$default = $row[4];
		$extra = $row[5];
		if ($extra !== "") { $extra .= ' '; }
		$this->output .= "  `$name` $type $null $extra,\n";
	}
	if (sizeof($uniqueKey) > 0) {
	  $this->output .= "  UNIQUE KEY  (";
	  $virgule="";
	  foreach ($uniqueKey as $val) {
	  	$this->output .= $virgule."`".$val."`";
	  	$virgule=",";
	  }
	  $this->output .= ")";
	}
	if ($primary) {
	  $this->output .= "  PRIMARY KEY  (`$primary`)";
	}
	$this->output .= "\n);\n";
}

}
?>