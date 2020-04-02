<?php
include '../../TD/2/re_mail.php';
include '../../TD/2/re_jour.php';
include '../../TD/2/re_heure.php';
include '../../TD/3/saisie_fiable.php';
include '../../TD/8/debut_html.php';
include '../../TM/7/etes_vous_libre.php';

$jour = saisie_fiable($_POST, 'jour', RE_JOUR);
$debut = saisie_fiable($_POST, 'debut', RE_HEURE);
$fin = saisie_fiable($_POST, 'fin',  RE_HEURE);
$qui = saisie_fiable($_POST, 'qui', RE_MAIL);
$file = $_FILES['ICS']['tmp_name'];
if ($file AND $jour AND $debut AND $fin AND $qui) {
    $r = etes_vous_libre($file, $_POST['jour'], $_POST['debut'], $_POST['fin'], $_POST['qui']);
    include 'envoi_ics.php';
    envoi_ics($r, $r ? 'rdv.ics' : 'Pas libre');
  } else {
	//Valeur d'expiration arbitraire, car le cookie va être supprimé par la JS
	if($jour === false)
	  setcookie("jour", "erreur", time()+3600);
	
	if($debut === false)
	  setcookie("debut", "erreur", time()+3600);
	  
	if($fin === false)
	  setcookie("fin", "erreur", time()+3600);
	  
	if($qui === false)
	  setcookie("qui", "erreur", time()+3600);

    echo debut_html('Créneau dans ICS', array('.erreur {border: 2px dashed red}'));
    echo "<body onload='set_class_from_cookie()'>\n<h1>Créneau dans ICS</h1>\n";
    include "../../TM/7/creneau.html";
    echo "<script type='application/javascript' src='set_class_from_cookie.js'></script>\n";
    echo "</body></html>\n";
}
?>
