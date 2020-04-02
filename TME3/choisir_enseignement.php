<?php
include_once('../../TM/2/debut_html.php');
include_once('../../TD/3/saisie_fiable.php');
include_once('../../TD/3/saisies_indicees.php');
include_once('trouver_sous_index.php');
include_once('desc_diplomes.php');
  
function choisir_enseignements($id, $annee, $desc)
{
    $title = "Choix pour $id";
    $ens = trouver_sous_index($desc, $annee);
    if (!is_array($ens) OR !intval($id)) {
        $r = "Piratage.";
        $title = "Erreur: $title";
    } else {
        $r = "<form action='presenter_choix.php' method='post'>" .
            saisies_indicees($ens) .
            "<fieldset>" .
            "<input type='radio' name='mode' id='p' value='p' checked='checked' />" .
            "<label for='p'>Suivi présentiel</label>" .
            "<input type='radio' name='mode' id='d' value='d' />" .
            "<label for='d'>Suivi à distance</label>" .
            "</fieldset><div>" .
            "<input type='hidden' name='id' value='$id' />" .
            "<input type='hidden' name='annee' value='$annee' />" .
            "<input type='submit'/>" .
            "</div></form>";
    }
    return debut_html($title) . "<body><h1>$title</h1>$r</body></html>\n";
}

echo choisir_enseignements($_POST['id'], $_POST['annee'], $desc_diplomes);
?>
