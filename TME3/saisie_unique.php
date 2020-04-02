<?php
// Utiliser include_once pour permettre des demandes d'inclusion superflues
include_once('../../TM/2/debut_html.php');

if (isset($_GET['id']) AND intval($_GET['id'])) {
    include_once('desc_diplomes.php');
    include_once('tableau_en_select.php');
    echo tableau_en_select($desc_diplomes, $_GET['id']);
} else {
    $title = (isset($_GET['id']) ? 'Erreur: ' : '') . 'Identification';
    $body =  "<body>\n$title" . 
            "<form action='saisie_unique.php' method='get'><fieldset>\n" .
            "<label for id='nom'>Identifiant numérique : </label>\n" .
            "<input id='id' name='id' />\n" .
            "</fieldset></form></body></html>\n";
        echo debut_html($title) . $body;
}
?>
