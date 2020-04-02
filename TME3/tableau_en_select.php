<?php
include_once('../../TM/2/debut_html.php');

function tableau_en_select($desc_diplomes, $id)
{
    $sel = '<option></option>';
    foreach ($desc_diplomes as $diplome => $annees) {
        $les_annees = '';
        foreach($annees as $annee => $ens) {
            $les_annees .= "<option>$annee</option>\n";
        }
        $sel .= "<optgroup label='$diplome'>$les_annees</optgroup>\n";
    }

    if (!$sel) {
        $titre = "Erreur :" ;
        $sel = "Pas de groupe";
    } else $titre = '';

    $sel = "<form action='choisir_enseignement.php' method='post'><fieldset>".
            "<label for='annee'>Choisissez une année</label>\n".
            "<select id='annee' name='annee'>$sel</select>\n" . 
            "<input type='hidden' name='id' value='$id' />\n" .
            "<input type='submit' />" .
            "</fieldset></form>\n";

    return debut_html($titre . "Choix de l'année pour $id") .
        "<body>$sel</body></html>\n";
}
?>
