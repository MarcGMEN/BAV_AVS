<?
class ftp {
  var $flot;
  var $home;

  var $host;
  var $port;
  var $log;
  var $pass;


  var $modeExec = "ssh";

  function ftp($host, $port, $log, $pass)
  {
    $this->host = $host;
    $this->port = $port;
    $this->log  = $log;
    $this->pass = $pass;

    $this->connect();
  }

  function connect()
  {
    if ($this->flot = ftp_connect($this->host,$this->port))
    {
      if ($res = ftp_login($this->flot,$this->log,$this->pass)) {
        ftp_pasv($this->flot, true);
      }
      else {
        echo "<b>PB d'ouverture sur ".$this->host." avec :".$this->log."</b>";
        trigger_error("<b>PB d'ouverture sur ".$this->host." avec :".$this->log."</b>",E_USER_ERROR);
      }
    }
    else {
      echo "<b>PB d'ouverture sur ".$this->host." avec :".$this->log."</b>";
      trigger_error("<b>PB de connection FTP : ".$this->host."</b>",E_USER_ERROR);
    }

    $this->home =  $this->pwd();
  }

  function quit()
  {
    ftp_quit($this->flot);
  }

  function pwd()
  {
    return ftp_pwd ($this->flot);
  }

  function site($cmd)
  {
    ftp_site($this->flot,$cmd);
  }

  function taille_fichier($fic)
  {
    //return ftp_size($this->flot,$this->pwd()."/".$fic);
    return ftp_size($this->flot,$fic);
  }

  function date_fichier($fic)
  {
    return date("d/m/Y H:i:s",ftp_mdtm($this->flot,$fic));
  }

  function chdir($dir) {
    //error_reporting(4);
    if (!ftp_chdir ($this->flot, $dir)) {
      trigger_error("<b>PB de chdir FTP : ".$this->host."</b>",E_USER_ERROR);
    }
    //error_reporting(1);
  }

  function liste_fichiers()
  {
    return ftp_nlist ($this->flot,".");
  }


  function liste_fichiers_mask_tri($mask, $sort) {
    $ftp_rawlist =$this->liste_fichiers_mask($mask, 1);
    $dirName=dirname($mask);
    	
    foreach ($ftp_rawlist as $k => $v) {
      $info = array();
      $vinfo = preg_split("/[\s]+/", $v, 9);
      if ($vinfo[0] !== "total") {
        $info['chmod'] = $vinfo[0];
        $info['num'] = $vinfo[1];
        $info['owner'] = $vinfo[2];
        $info['group'] = $vinfo[3];
        $info['size'] = $vinfo[4];

        $info['month'] = $vinfo[5];
        $info['day'] = $vinfo[6];
        $info['time'] = $vinfo[7];
        $mois="00";
        switch ($info['month']) {
          case "Jan" : $mois="01";break;
          case "Feb" : $mois="02";break;
          case "Mar" : $mois="03";break;
          case "Apr" : $mois="04";break;
          case "May" : $mois="05";break;
          case "Jun" : $mois="06";break;
          case "Jul" : $mois="07";break;
          case "Aug" : $mois="08";break;
          case "Sep" : $mois="09";break;
          case "Oct" : $mois="10";break;
          case "Nov" : $mois="11";break;
          case "Dec" : $mois="12";break;
        }
        $info['dateF'] = $info['day']."/".$mois." ".$info['time'];
        $info['date'] = $mois.$info['day'].str_replace(":", "", $info['time']);
        //      			$info['name'] = $vinfo[8];
        $vname = preg_split("[->]", $vinfo[8]);
        $info['name'] = $vname[0];
        $info['basename'] = basename($info['name']);
        $info['dirname'] = dirname($info['name']);
        if($info['dirname'] == "." ) $info['dirname'] = $dirName;
        	
      }
      $rawlist[$info['name']] = $info;

    }
    $dir = array();
    $file = array();
    if ($rawlist) {
      //print_r($rawlist );
      foreach ($rawlist as $k => $v) {
        if ($v['chmod']{0} == "d") {
          $dir[$k] = $v;
        } elseif (($v['chmod']{0} == "-") || ($v['chmod']{0} == "l")) {
          $file[$k] = $v;
        }
      }
      //print_r($file);
      switch ($sort) {
        case "date_inverse" : uasort($file,"cmpDateInverse");
        break;
        case "date" : uasort($file,"cmpDate");
        break;
        case "name" : uasort($file,"cmpName");
        break;
      }
      //print_r($file);
    }
    return $file;
  }

  function liste_fichiers_mask($mask, $detail)
  {
    $tabList = array();
    if ($detail) {
      $tabList = ftp_rawlist ($this->flot,"$mask");
    }
    else {
      $tabList = ftp_nlist ($this->flot,"$mask");
    }
    if (!is_array($tabList)) {
      $tabList = array();
    }
    return $tabList;

  }

  function setModeExec($mode) {
    $this->modeExec = $mode;
    if ($this->modeExec != "rsh") {
      $this->modeExec = "ssh";
    }
  }

  function exec($cmd)
  {
    $cmd1=$this->modeExec." ".$this->host." -l ".$this->log;
    //$cmd1=$this->modeExec." ".$this->log."@".$this->host;
    $cmd1.=" \"".$cmd."\"";
    //		echo $cmd1;
    return shell_exec($cmd1);
  }

  function envoyer($fichierLocal,$fichierServeur)
  {
    if (!ftp_put($this->flot, $fichierServeur, $fichierLocal, FTP_BINARY)) {
      trigger_error("L'envoi Ftp a echoue",E_USER_ERROR);
    }
  }

  function rename($ficAV,$ficAP)
  {
    if (!ftp_rename($this->flot, $ficAV, $ficAP)) {
      trigger_error("Le rename Ftp a echoue",E_USER_ERROR);
    }
  }

  function recuperer($fichierServeur,$fichierLocal)
  {
    if (!ftp_get($this->flot, $fichierLocal, $fichierServeur, FTP_BINARY)) {
      print_r(error_get_last());
      //trigger_error("La recuperation Ftp a echoue ! ".$this->pwd()."/".$fichierServeur." sur ".$fichierLocal, E_USER_ERROR);
    }
  }

  function ecriture($fichier, $tabEcriture)
  {
    $cpt=0;
    //error_reporting(4);
    $fileTMP="/tmp/".$fichier;
    $file = fopen($fileTMP, "w+");
    if ($file) {
      while(list($key,$val) = each($tabEcriture)){
        fwrite($file, chop($val)."\n");
      }
      fclose($file);
    }
    $this->envoyer($fileTMP,$fichier);
    unlink($fileTMP);
    //error_reporting(1);
  }

  function lecture($fichier)
  {

    $cpt=0;
    error_reporting(4);
    /*$file = fopen("ftp://".$this->log.":".$this->pass."@".$this->host."/".$this->pwd()."/".$fichier, "r");
     if ($file) {
     while ($buffer = fgets($file, 1024)) {
     $tabResult[$cpt++]=$buffer;
     }
     fclose($file);
     }
     */
    $fileTMP="/tmp/".$fichier;
    try {
      try {
        $this->recuperer($fichier,$fileTMP);
      }
      catch (ErrorException $e) {
        echo "ERREUR $e";
      }
      $file = fopen($fileTMP, "r");
      if ($file) {
        while ($buffer = fgets($file,1024)) {
          $tabResult[$cpt++]=$buffer;
        }
      }
      else {
        //echo "Fichier $fileTMP non present";
      }
      fclose($file);
      unlink($fileTMP);
    }
    catch (ErrorException $e ) {
      throw $e;
    }
    error_reporting(1);

    return $tabResult;
  }
}

?>