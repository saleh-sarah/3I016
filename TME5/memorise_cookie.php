<?php
require_once('debut_html.php');
include('naviguer.php');
define("COOKIE_path", "COOKIE/");

function memorise_cookie()
{
  if (!isset($_COOKIE['visite'])) {
    $v = 1;
    $f = COOKIE_path .  md5(mt_rand() . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
  } else {
    $f = $_COOKIE['visite'];
    $v = array_shift(file($f));
  }
  if ($d = fopen($f, 'w')) {
    fputs($d, $v+1);
    fclose($d);
  }
  setcookie('visite', $f);
  return $v;

}

$n = isset($_POST['page']) ? $_POST['page'] : 1;
$titre = "Page $n";
$v = memorise_cookie();
echo debut_html($titre), "<body>\n<h1>", $titre , "</h1>\n";
if (!is_numeric($n))
  echo "<div>Bon voyage pour " . ($bd[$n] * (($v > 1) ? ($v-1) : 1)) . "€ </div>";
else {
  $h = "";
  echo naviguer($bd, $n, $v, $h);
}
echo "</body</html>\n";

?>
