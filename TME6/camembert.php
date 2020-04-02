<?php
require_once('phraser_table.php');
require_once('envoi_svg.php');

// somme des nombres sur une ligne
define('TOTAL', 10);

function camembert($table, $css, $hauteur=11, $largeur=5)
{
	$i = 0;
	$angle = 0;
    $res = array();
	foreach ($table as $ligne) {
        $res[]= sprintf("<g transform='translate(%d,%d)'>\n", (($i*5)+3) * $largeur, $hauteur);
        $x = $hauteur;
        $y = 0;
        foreach($ligne as $v) {
            $c = $v['class'];
            $val = $v['colspan'];
            $angle += $val*(3.14*2/TOTAL);
            $xx = cos($angle) * $hauteur;
            $yy = sin($angle) * (0 - $hauteur);
            $res[]= sprintf("<path d='M0,0 %f %f A %d,%d 0 %d 0 %f %f' class='%s'/>",
                      $x,
                      $y,
                      $hauteur, // cmd lineto implicite lorsque M a + de 2 args
                      $hauteur,
                      (($val > 5) ? 1 : 0),
                      $xx,
                      $yy,
                      $c);
          $x = $xx;
          $y = $yy;
	  }
	  $i++;
	  $res[]= "</g>\n";
	}
    envoi_svg(join("\n", $res), $largeur*(($i*5)+3), $hauteur*2, $css);
}
$obj = new sax_html2svg;
phraser('table-pour-svg.html', $obj);
camembert($obj->table, $obj->css);
?>
