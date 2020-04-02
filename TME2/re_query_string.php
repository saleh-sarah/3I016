<?php
// On accepte des crochets dans un nom
// meme s'ils sont mal utilises
define('RE_QUERY_STRING', '@([]\w[]*)=([^&]*)@');

function query_string($c)
{
    if (!preg_match_all(RE_QUERY_STRING, $c, $m, PREG_SET_ORDER))
        return array();
    $res = array();
    foreach($m as $k => $p) $res[$p[1]] = $p[2];
    return $res;
}
// test
// var_dump(query_string('&h[Z]=foo&a=9'));
?>
