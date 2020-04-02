<?php

function etes_vous_libre($file, $jour, $rdvd, $rdvf, $qui) {
    if (!is_readable($file)) return array();
    $lines = file($file);
    $creneau = array();
    $re = '/^DT(START|END).*:'.$jour.'T(.*)$/';
    foreach ($lines as $l) {
	    if (preg_match($re, $l, $a)){
            $creneau[$a[1]] = $a[2];
            if ($a[1] == 'END') {
                if ((($creneau['END'] > $rdvd) && ($creneau['END'] < $rdvf))
                || (($creneau['START'] > $rdvd) && ($creneau['START'] < $rdvf))
                || (($creneau['START'] < $rdvd) && ($creneau['END'] > $rdvd))){
                    return array();
                }
            }
	    }
    }
    $f = array_pop($lines);
    $lines[]="BEGIN:VEVENT\n";
    $lines[]="DESCRIPTION: RDV\n";
    $lines[]="DTSTART;TZID=Europe/Paris:$jour". 'T' . $rdvd . "\n";
    $lines[]="DTEND;TZID=Europe/Paris:$jour". 'T' . $rdvf . "\n";
    $lines[]="ATTENDEE:$qui\n";
    $lines[]="END:VEVENT\n";
    $lines[]= $f;
    return $lines;
}
?>
