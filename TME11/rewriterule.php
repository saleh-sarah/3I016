<?php           
function TraiteHtaccess_RewriteRule($etapes, $arg)
{
    preg_match('@^([^ ]+)\s(.*)@', $arg, $m);
    $e = preg_match('@' . $m[1] . '@', $etapes[1][2]);
    return $e ? array(200, $m[2]) : array();
}

?>
