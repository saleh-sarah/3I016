<?php
include_once('../../TD/4/lire_entetes.php');
include_once('re_url.php');
       
function requete_ressource($req, $url) {
    if (!preg_match(RE_URL, $url, $r) OR (!$r[1]))
        return array(400, '', "Mauvaise URL", $url);
    list(, $serveur, $port, $ressource,) = $r;
    if (!$port) $port = 80;
    $sock = fsockopen($serveur,$port);
    if (!$sock)
        return array(500 , 'Injoignable', "$serveur:$port injoignable");
    else {
        $req .= " $url HTTP/1.1\r\nHost: $serveur\r\n\r\n";
        fputs($sock, $req);
        $status = fgets($sock);
        $entetes = lire_entetes($sock);
        $page='';
        while ( !feof($sock) ) $page .= fgets($sock);
        return array($status, $entetes, $page);
    }
}

// Test
//var_dump(requete_ressource('GET', 'http://127.0.0.1/');
?>
