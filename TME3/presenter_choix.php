<?php 
error_reporting(E_ALL);
include_once('../../TM/2/debut_html.php');
include_once('../../TD/3/saisies_indicees.php');
include_once('desc_diplomes.php');
include_once('trouver_sous_index.php');

// controler les erreurs 

$titre = "Enseignements choisis par ". htmlspecialchars($_POST['id']);
echo debut_html($titre);
echo "<body>\n<h1>", $titre, "</h1>\n";
$ens = trouver_sous_index($desc_diplomes, $_POST['annee']);
echo indices_choisis($_POST['ens'], $ens);
echo '<div>Mode: ', htmlspecialchars($_POST['mode']), '</div>';
echo "</body></html>\n";
?>
