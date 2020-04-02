<?php
include_once('re_balapache.php');

function pseudo_xml_to_array_xml($path){
  
  $text = file_exists($path) ? file($path) : array($path);
  $resultat = array("<CONF>\n");
  foreach($text as $l) {
      if (!preg_match(RE_VIDE, $l)) {
          if (preg_match(RE_APACHE_BAL, $l, $a)
          OR  preg_match(RE_APACHE_DIR, $l, $a)) {
              list(,$bal, $delim, $val, $fin) = $a;
              if (!$delim) 
                  $delim = strpos($val, '"') !== false ? "'" : '"';
              $l = "<$bal v=$delim$val$delim" . (!trim($fin) ? " /" : '') . ">\n";
          }
          $resultat[]= $l;
      }
  }
  $resultat[]= "</CONF>\n";
  return $resultat;
}

//Test
#echo join('',pseudo_xml_to_array_xml( "<foo x>"));
#echo join('',pseudo_xml_to_array_xml( "<foo 'x'>"));
#echo join('',pseudo_xml_to_array_xml( '<foo "x">'));
#echo join('',pseudo_xml_to_array_xml( "<foo '\"x'>"));
#echo join('',pseudo_xml_to_array_xml( '<foo "\'x">'));
#foreach(pseudo_xml_to_array_xml("httpd.conf") as $l) echo $l;
?>
