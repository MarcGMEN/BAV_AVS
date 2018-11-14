<?
 //echo "fiche 64"."<br/>";
 $fiche=64;
//  echo dechex(64)."<br/>";   
//  echo decoct(64)."<br/>";   
//  echo decbin(64)."<br/>";   
//  echo base_convert(64, 16, 6)."<br/>"; 
//  echo crypt($fiche)."<br/>";   
 for($i=1;$i<5000;$i++) {
    echo substr(hash_hmac('md5', $i, 'avs44'),0,5)."<br/>";
 }
?>