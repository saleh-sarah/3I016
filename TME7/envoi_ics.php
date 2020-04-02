<?php

function envoi_ics($ics, $nom)
{
    if (!$ics) {
        header('Content-Type: text/plain; charset=utf-8');
        echo $nom;
    } else {
        header("Content-Type: text/calendar; charset=UTF-8");
        header("Content-Transfer-Encoding: 8bit");
        $date = gmdate("D, d M Y H:i:s", time());
        header("Content-Disposition: inline; filename=\"$nom\";creation-date=$date"); 
        foreach($ics as $ligne) echo $ligne;
    }
}
?>
