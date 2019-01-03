<?php
class XMLToArray {

  var  $theFile;
  var  $theFileOrigine;

  function XMLToArray($file) {
    $this->theFile = $file;
    $this->theFileOrigine = $file;
    
    $trouve=false;
    for ($index = 0; $index <3; $index++) {
      try {
        if (my_is_dir(dirname($this->theFile))) {
          if (!file_exists($this->theFile )) {
            $this->theFile  = "../".$this->theFile ;
          }
          else {
            $trouve=true;
            break;
          }
        }
        else {
          $this->theFile  = "../".$this->theFile ;
        }
      }
      catch (Exception $e) {
        $this->theFile  = "../".$this->theFile ;
      }
    }

    if (!$trouve) {
      //echo "Impossible de trouver : $file " ;
      $this->theFile = "";
    }
  }

  function parse() {
    // print_r($this->theFile);
    if ($this->theFile) {
      return $this->convert(simplexml_load_file($this->theFile));
    }
  }

  function array_to_xml2($array, $root="root",$level=1 ) {
    $xml = '';
    if ($level==1) {
      $xml .= "<$root>\n";
    }
    foreach ($array as $key=>$value) {
      //print_r("value = ".$value);
      $key = strtoupper($key);
      if (is_object($value)) {
        $value=get_object_vars($value);
      }// convert object to array
      if (is_array($value)) {
        //echo "key=$key<br/>";
        // si $keySuiv == $key alors tableau
        $keys=array_keys($value);
        if (is_numeric($keys[0])) {
          //  echo "dans un tableau....";
          //$xml .= str_repeat("\t",$level)."<$key>\n";
          /*echo "<pre>";
          print_r($value);
          echo "</pre>";*/
          $auMoinsUn=false;
          $index=0;
          foreach ($value as $value2) {
            if (is_array($value2)) {
              $textAtt=$key;
              //echo "un sous ensemble de tag.....$key => ";
              //print_r($value2);

              if ($key != "ATTRIBUTES" && $key != "@ATTRIBUTES" && $key != "VALUE" ){
                if (isset($value2['attributes']) && is_array($value2['attributes'])) {
                  foreach($value2['attributes'] as $keyA => $valA) {
                    $textAtt.=" $keyA=\"$valA\"";
                  }
                }
                else {
                  if (isset($value2['@attributes']) && is_array($value2['@attributes'])) {
                    foreach($value2['@attributes'] as $keyA => $valA) {
                      $textAtt.=" $keyA=\"$valA\"";
                    }
                  }
                }
                //echo " ====> $textAtt ";
                if (isset($value2['value'])) {
                  $value=$value2['value'];
                  //echo "Ajout value=$value<br/>";
                  if ((trim($value)!='') || 
                    ($index == (sizeof($value2)-1) && !$auMoinsUn) ) {
                    $auMoinsUn=true;
                    if (htmlspecialchars($value)!=$value) {
                      $xml .= str_repeat("\t",$level).
                                    "<$textAtt><![CDATA[$value]]>". // changed $key to $key2... didn't work otherwise.
                                    "</$key>\n";
                    } else {
                      $xml .= str_repeat("\t",$level).
                                    "<$textAtt>$value</$key>\n"; // changed $key to $key2
                    }
                  }
                }
                else {
                  $retour = $this->array_to_xml2($value2, "", $level+1);
                  /*if (preg_match("*>+[a-zA-Z0-9./: _\-יטא]+<*", $retour)) {
                    echo "pas vide";
                  }*/
                  // si pas de valeur dans la suite
                  // mais si c'est le dernier on met un champ vide
                  /*echo htmlspecialchars($retour)."<br/>";
                  echo "($index == ".(sizeof($value)-1)." && !".$auMoinsUn.")";
                  $res=preg_replace("*>([a-zA-Z0-9./: _\-יטא]+)<*",'>TOTO<', $retour);
                  echo htmlspecialchars($res)."<br/>";*/
                  if (preg_match("*>([a-zA-Z0-9./: _\-יטא]+)<*", $retour) || 
                    ($index == (sizeof($value)-1) && !$auMoinsUn) ) {
                     //echo "ajout de ".htmlspecialchars($retour)."<br/>";
                    $xml .= str_repeat("\t",$level)."<$textAtt>\n";
                    $xml .= $retour;
                    $xml .= str_repeat("\t",$level)."</$key>\n";
                    $auMoinsUn=true;
                  }
                }
                $index++;
              } // fin tableau d'attribut
               

            }
            else {
              //echo "value=$value2<br/>";
              if (trim($value2)!='') {
                if (htmlspecialchars($value2)!=$value2) {
                  $xml .= str_repeat("\t",$level).
                                    "<$key><![CDATA[$value2]]>". // changed $key to $key2... didn't work otherwise.
                                    "</$key>\n";
                } else {
                  $xml .= str_repeat("\t",$level).
                                    "<$key>$value2</$key>\n"; // changed $key to $key2
                }
              }
            }
          }
          //$xml .= str_repeat("\t",$level)."</$key>\n";
        }
        else {
          $textAtt=$key;
          //echo "Ajout d'un tag simple $key ";
          if ($key != "ATTRIBUTES" && $key != "@ATTRIBUTES" && $key != "VALUE") {
          		if (isset($value['attributes']) && is_array($value['attributes'])) {
          		  foreach($value['attributes'] as $keyA => $valA) {
          		    $textAtt.=" $keyA=\"$valA\"";
          		  }
          		}
          		else {
          		  if (isset($value['@attributes']) && is_array($value['@attributes'])) {
          		    foreach($value['@attributes'] as $keyA => $valA) {
          		      $textAtt.=" $keyA=\"$valA\"";
          		    }
    	        	}
        	  	}
        	  	//	echo " ====> $textAtt ";
        	  	if (isset($value['value'])) {
        	  	  $value=$value['value'];
        	  	  //		echo "Ajout value=$value<br/>";
        	  	  //if (trim($value)!='') {
        	  	  if (htmlspecialchars($value)!=$value) {
        	  	    $xml .= str_repeat("\t",$level).
                                    "<$textAtt><![CDATA[$value]]>". // changed $key to $key2... didn't work otherwise.
                                    "</$key>\n";
        	  	  } else {
        	  	    $xml .= str_repeat("\t",$level).
                                    "<$textAtt>$value</$key>\n"; // changed $key to $key2
        	  	  }
        	  	}
        	  	else {
        	  	  $xml .= str_repeat("\t",$level)."<$textAtt>\n";
        	  	  $xml .= $this->array_to_xml2($value, "", $level+1);
        	  	  $xml .= str_repeat("\t",$level)."</$key>\n";
        	  	}
          }
        }
      }
      else {
        //echo "Ajout value=$value<br/>";
        //if (trim($value)!='') {
        if (htmlspecialchars($value)!=$value) {
          $xml .= str_repeat("\t",$level).
                                    "<$key><![CDATA[$value]]>". // changed $key to $key2... didn't work otherwise.
                                    "</$key>\n";
        } else {
          $xml .= str_repeat("\t",$level).
                                    "<$key>$value</$key>\n"; // changed $key to $key2
        }
        //}
      }
    }
    if ($level==1) {
      $xml .= "</$root>\n";
    }
    return $xml;
  }

  function convert($xml) {
    if ($xml instanceof SimpleXMLElement) {
      $children = $xml->children();
      $return = null;
      /* echo "avec enfant <br/>";
       print_r($children);*/
    }
    foreach ($children as $element => $value) {
      /*echo "la value";
       print_r($value);
       echo "<br/>";*/

      if ($value instanceof SimpleXMLElement) {
        $values = (array)$value->children();
        $isTab=true;
        if ((isset($values['@attributes']) && count($values) == 1)) {
          $isTab=false;
        }
        if (count($values) > 0 && $isTab)  {
        //if (count($values) > 0) {
          if (is_array($return) &&  array_key_exists($element, $return ) &&  is_array($return[$element])) {
            //hook
            foreach ($return[$element] as $k=>$v) {
              if (!is_int($k)) {
                $return[$element][0][$k] = $v;
                unset($return[$element][$k]);
              }
            }
            $return[$element][] = $this->convert($value);
            //echo "return[$element] =".$return[$element]."<br/>";
          } 
          else {
            $return[$element] = $this->convert($value);
            foreach ($value->attributes() as $key=>$val) {
              $valueAtt=(array)$val;
              $return[$element]['@attributes'][$key]=$valueAtt[0];
            }
            //echo "return[$element] =".$return[$element]."<br/>";

          }
        } else {
          //echo "return[$element] =".$return[$element]."<br/>";
          if (!isset($return[$element])) {
            $return[$element]['value'] = utf8_decode(trim((string)$value));
            //echo "affect 0";
            foreach ($value->attributes() as $key=>$val) {
              $valueAtt=(array)$val;
              $return[$element]['@attributes'][$key]=$valueAtt[0];
              //echo "return[$element]['@attributes'][$key]= ".$valueAtt[0]."<br/>";
            }
            
          } else {
            if (!is_array($return[$element]) ||  (isset($return[$element]['@attributes']) && !isset($return[$element]['value']))) {
              //echo "affect 1 de $element : $value";
              $return[$element]['value'] = utf8_decode(trim((string)$value));
              foreach ($value->attributes() as $key=>$val) {
                $valueAtt=(array)$val;
                $return[$element]['@attributes'][$key]=$valueAtt[0];
                //echo "return[$element]['@attributes'][$key]= ".$valueAtt[0]."<br/>";
              }
            } else {
              if (isset($return[$element]['value'])) {
                $tmp=$return[$element]['value'];
                $return[$element]=array();
                $return[$element][0]['value'] = $tmp;
                if (isset($return[$element]['@attributes'])) {
                	$tmp1=$return[$element]['@attributes'];
                	$return[$element][0]['@attributes'] = $tmp1;
                }
              }
              //echo "affect 2";
              //echo sizeof($return[$element]);
              $index= sizeof($return[$element]);
              $return[$element][$index]['value'] = utf8_decode(trim((string)$value));
              foreach ($value->attributes() as $key=>$val) {
                $valueAtt=(array)$val;
                $return[$element][$index]['@attributes'][$key]=$valueAtt[0];
                //echo "return[$element]['@attributes'][$key]= ".$valueAtt[0]."<br/>";
              }
            }
          }
        }
      }
    }

    if (is_array($return)) {
      return $return;
    } else {
      return false;
    }
  }


  function saveXML($xml) {
    if ($this->theFile) {
      if ($fpXML = fopen($this->theFile, 'w')) {
        fwrite($fpXML,"<?xml version='1.0' encoding='ISO-8859-1'?>\n");
        fwrite($fpXML, $xml);
        fclose($fpXML);
      }
      else {
        echo "Erreur sur d'ecriture sur ".$this->theFile;
      }
    }
    else {
      echo "Erreur pas de fichier pour la sauvegarde sur ".$this->theFileOrigine;
    }
  }

}

function XMLToArray($file) {
  $xmlArray = new XMLToArray($file);
  return $xmlArray->parse();
}

function extractXMLToArray($file,$extand='') {
  $tabTmp= XMLToArray($file);
  /*echo "<pre>";
   print_r($tabTmp);
   echo "</pre>";*/
  if (is_array($tabTmp)) {
    extractRecur($tabTmp,$extand,"");
  }
}
function extractRecur($tab,$extand,$keyOld) {
  foreach ($tab as $key => $val) {
    
    if ($key != "@attributes" || is_numeric($key)) {
      if (is_array($val ) && !isset($val['value']) ) {
        extractRecur($val,$extand,$key);
      }
      else {
        if (isset($val['value'])) {
          $keyArray=false;
          if (is_numeric($key)) {
            $keyArray=true;
            $index=$key;
            $key=$keyOld;
          }
          $key1=$key;
          if ($extand) {
            $key1=$extand."_".$key;
          }
          global $$key1;
          if ($keyArray) {
            if (isset($$key1)) {
                          $tabKey=$$key1;
            }
            else {
              $tabKey= array();
            }
            $tabKey[$index]=trim($val['value']);
            $$key1=$tabKey;
            //print_r($$key1);
          }
          else {
            $$key1=trim($val['value']);
          }
          //   define($key1,$val);
          //     define($key,$val);
        }
      }
    }
  }
}
?>