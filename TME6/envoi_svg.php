<?php
function envoi_svg($code_svg, $largeur, $hauteur, $css='',
                   $transX=10, $transY=10,
                   $scaleX=10, $scaleY=10)
{
    $width = ($largeur + $transX)*$scaleX;
    $height = ($hauteur + $transY)*$scaleY;
    header("Content-Type: image/svg+xml");
    echo "<!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>\n";
	if ($css) echo "<?xml-stylesheet type='text/css' href='$css' ?>\n";
	echo "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='$width' height='$height'>\n";	  
	echo "<g transform='translate($transX,$transY),scale($scaleX,$scaleY)'>\n";
    echo $code_svg;
	echo "</g>\n</svg>"; 
}
// test
envoi_svg("<circle cx='25' cy='25' r='20'  fill='blue' stroke='red' />", 45, 45)
?>
