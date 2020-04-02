<?php
// Utilser la notation "?:" après une "(" pour que la sous-chaine delimitee
// par la paire de parentheses ne soit pas recopiee dans le tableau final
define('RE_URL', "@^(?:\w+://([^/:]*)(?::(\d+))?)?(/[^?]*)[?]?(.*)$@");
?>
