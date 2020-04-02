<?php
include '../../TD/2/re_mail.php';
include '../../TD/2/re_jour.php';
include '../../TD/2/re_heure.php';
include '../../TM/2/debut_html.php';
include '../../TD/3/saisie_fiable.php';
include 'etes_vous_libre.php';

$jour = saisie_fiable($_POST, 'jour', RE_JOUR);
$debut = saisie_fiable($_POST, 'debut', RE_HEURE);
$fin = saisie_fiable($_POST, 'fin',  RE_HEURE);
$qui = saisie_fiable($_POST, 'qui', RE_MAIL);
$file = $_FILES['ICS']['tmp_name'] ;
if ($file AND $jour AND $debut AND $fin AND $qui) {
    $r = etes_vous_libre($file, $_POST['jour'], $_POST['debut'], $_POST['fin'], $_POST['qui']);
    include 'envoi_ics.php';
    envoi_ics($r, $r ? 'rdv.ics' : 'Pas libre');
  } else {
    echo debut_html('Créneau dans ICS');
    echo "<body>\n<h1>Créneau dans ICS</h1>\n";
    include 'creneau.html';
    echo "</body></html>\n";
}
?>
