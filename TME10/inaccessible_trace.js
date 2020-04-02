function bouger(div){
    var t = Math.ceil(Math.random()*(window.innerHeight-75));
    var l = Math.ceil(Math.random()*(window.innerWidth-75));
    div.style.top = t +"px" ;
    div.style.left= l +"px" ;
    ajax("inaccessible.php?l="+l+"&t=" + t, '', function (xhr) {})
}

function merci(button){
     ajax("inaccessible.php", '', function(xhr) {trace_inaccessible(xhr, button)})
}

function trace_inaccessible(xhr, button) {
 if (xhr.readyState == 4) {
	alert("Merci d'avoir dit " + button.firstChild.data)
	alert("Vos essais : \n" + xhr.responseText);
 }
}

// Fonction d'envoi de requetes asynchrones:
// url: ressource sur le serveur courant, avec query-string eventuelle
// flux: flux d'entree en cas de methode POST
// rappel: fonction a appliquer sur l'objet Ajax lorsque le serveur repond
// method: methode HTTP (GET par defaut)
function ajax(url, flux, rappel, method) {
  var r = window.XMLHttpRequest ? new XMLHttpRequest() :
    (window.ActiveXObject ?  new ActiveXObject("Microsoft.XMLHTTP") : '');
  if (!r) return false;
  r.onreadystatechange = function () {rappel(r);}
  r.open(method ? method : 'GET', url, true);
  if (flux)
      r.setRequestHeader("Content-Type", 
                         "application/x-www-form-urlencoded; ");
  r.send(flux);
  return true;
}