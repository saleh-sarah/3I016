<?php
require_once('phraser_table.php');
require_once('envoi_svg.php');

function rectangle($table, $css='', $hauteur=11, $largeur=5)
{
	$res = array();
	$i = 0;
	foreach ($table as $ligne) {
        $j = 0;
        $i++;
        foreach($ligne as $v) {
            $c = $v['class'];
            $h = $v['colspan'];
            $x = $j*$largeur;
            $y = ($i*$hauteur) - $h;
            $res[]= "<rect x='$x' y='$y' width='$largeur' height='$h' class='$c' />";
            $j++;
        }
	}
    envoi_svg(join("\n", $res), $j*$largeur, $i*$hauteur, $css);
}
$obj = new sax_html2svg;
phraser('table-pour-svg.html', $obj);
rectangle($obj->table, $obj->css);
?>
