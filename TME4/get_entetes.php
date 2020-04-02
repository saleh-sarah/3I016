<?php
require('../2/debut_html.php');
require('../../TD/2/tableau_en_table.php');
require('requete_ressource.php');
error_reporting(E_ALL);

$err = '';
$r = requete_ressource('HEAD', isset($_GET['url']) ? $_GET['url'] : '');
if (!is_array($r))
    $err = $r;
else {
    $t = array_combine(array_map('htmlspecialchars', array_keys($r[1])),
    array_map('htmlspecialchars', array_values($r[1])));
}
$title = "Visualiser les en-têtes";
if ($err)
    $title = "ERREUR : ". $title;
echo debut_html($title);
echo "<body>\n";
if ($err)
    echo $err;
else {
    echo tableau_en_table($t, "En-têtes reçus sur " . $_GET['url']);
    echo "Status: ", preg_match('@(\d\d\d)@', $r[0], $m) ? $m[1] : 500;
    echo " Longueur effective : ", strlen($r[2]);
}
echo "</body></html>\n";
?>
