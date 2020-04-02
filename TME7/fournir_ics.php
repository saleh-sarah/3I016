<?php
if (empty($_FILES["ics1"]['tmp_name']) OR
    empty($_FILES["ics2"]['tmp_name'])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" 
        "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Transmission d'agendas </title></head> 
  <body> 
  <h1>Transmission d'agendas </h1></head> 
  <form action="fournir_ics.php" method="post" enctype="multipart/form-data"> 
  <fieldset>
  <label for='ics1'>Premier fichier ICS</label>
  <input type='file' accept='text/calendar' name='ics1' id='ics1' />
  </fieldset> <fieldset>
  <label for='ics2'>Deuxième fichier ICS</label>
  <input type='file' accept='text/calendar'  name='ics2' id='ics2' />
  </fieldset> <fieldset>
  <input type='submit' value='Fusionne'  /> 
  </fieldset>
  </form> 
  </body> 
</html>
<?php
} else {
  include 'envoi_ics.php';
  include 'fusionne_ics.php';
  $res = fusionne_ics($_FILES["ics1"]["tmp_name"], $_FILES["ics2"]["tmp_name"]);
  envoi_ics($res, 'événements_fusionnés.ics');
}
?>
