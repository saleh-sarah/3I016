<?php

// phpinfo() fournit:
// 1. 7.0.30
// 2. built: Jun 14 2018 13:50:25
// 3. $_SERVER indiquee en fin de page
 
// 2e partie
// charger la fonction tableau_en_table
require("../../TD/2/tableau_en_table.php");
// et visualiser la super globale
echo tableau_en_table($_SERVER, 'Informations sur le serveur');
 ?>
