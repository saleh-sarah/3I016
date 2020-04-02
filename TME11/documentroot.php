<?php

include 'pseudo_xml_vers_tableau.php';
include '../../TD/6/interface_sax.php';
define('HTTPD_CONF', '/etc/httpd/conf/httpd.conf'); // Linux

class sax_httpd_conf implements preneurs_sax
{
    var $roots = array();
    var $ports = array(80);
    var $names = array('localhost');

    function ouvrante($phraseur, $name, $attrs){
        array_push($this->pile, $name);
        if ($name == 'VirtualHost') {
            preg_match('#^([^:]*)(:(\d+))?$#', $attrs['v'], $a);
            array_push($this->ports, $a[3] ? $a[3] : 80);
            array_push($this->names, $a[1] ? $a[1] : '*');
        } elseif ($name == 'ServerName')
              $this->names[count($this->names)-1] = $attrs['v'];
        elseif ($name == 'DocumentRoot') {
            $n = $this->names;
            $p = $this->ports;
            $this->roots[$n[count($n)-1]][$p[count($p)-1]] = $attrs['v'];
    }

    function fermante($phraseur, $name){
        array_pop($this->pile);
        if ($name == 'VirtualHost')
            array_pop($this->ports);
        array_pop($this->names);
    }

    function texte($parser, $data){}

    function analyse_http_conf($path, $obj)
    {
        $sax = xml_parser_create();
        xml_set_element_handler($sax,
                                array($obj, 'ouvrante'),
                                array($obj, 'fermante'));
        xml_parser_set_option($sax, XML_OPTION_CASE_FOLDING, false);

        $file_conforme_xml = pseudo_xml_to_array_xml($path);

        foreach($file_conforme_xml as $l) {
            echo $l;
            if (!xml_parse($sax, $l, false)) {
                $data = sprintf("Erreur XML : %s ! la ligne %d\n", 
                                xml_error_string(xml_get_error_code($sax)),
                                xml_get_current_line_number($sax));
            }
        }
        if (!$data) {
            if (!xml_parse($sax, '', true))
                $data = "Erreur XML: fichier incomplet";
        }
        return $data ? $data : $this->roots;
    }
}
// Pour tester
// $obj = new sax_httpd_conf();
// var_dump($obj->analyse_http_conf(HTTPD_CONF, $obj));

// Ajout pour la question 2 du TD 11

function TraiteDocumentRoot($host, $port)
{
    $obj = new sax_httpd_conf();
    $roots = $obj->analyse_http_conf(HTTPD_CONF, $obj);

    if (isset($roots[$host]) AND isset($roots[$host][$port]))
        return $roots[$host][$port];

    if (isset($roots['*']) AND isset($roots['*'][$port]))
        return $roots['*'][$port];

    return '/tmp/';
}

?>
