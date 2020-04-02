<?php
include '../../TD/6/phraser.php';
include '../../TD/6/interface_sax.php';
class sax_html2svg implements preneurs_sax {
    public $table = array();
    public $css = '';
    function ouvrante($phraseur, $name, $attrs)
    {
        switch ($name) {
        case "link":
if ($attrs['type'] == 'text/css') $this->css = $attrs['href'];
            break;
        case "tr":
            $this->table[] = array();
            break;
        case "td": 
            if (!isset($attrs['colspan'])) $attrs['colspan'] = 1;
            $this->table[count($this->table)-1][] = $attrs;
            break;
        }
    }
    function fermante($phraseur, $name) {}
    function texte($phraseur, $text) {}
}
?>
