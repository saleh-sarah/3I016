<?php 

function fusionne_ics($f1, $f2) 
{ 
    $f1 = file($f1); 
    $f2 = file($f2);
    // eliminer les cas pathologiques
    if (!$f1)
        return $f2;
    if (!$f2)
        return $f1;
    //suppression de BEGIN:VCALENDAR du fichier 2
    array_shift($f2);
    // suppression de l'entete jusqu'au BEGIN suivant
    while ($f2 AND !preg_match("/^BEGIN:/",$f2[0])) {
        array_shift($f2);
    }
    if (!$f2)
        // cas du fichier 2 sans aucun evenement.
        return $f1;
    //suppression du END:VCALENDAR du 1er
    array_pop($f1); 
    // le concaténer avec les événements du 2eme
    return array_merge($f1, $f2); 
}
?>
