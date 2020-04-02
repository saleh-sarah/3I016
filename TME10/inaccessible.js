function bouger(div){
    var t = Math.ceil(Math.random()*(window.innerHeight-75));
    var l = Math.ceil(Math.random()*(window.innerWidth-75));
     div.style.top = t +"px" ;
     div.style.left= l +"px" ;
}

function merci(rep){
     alert("Merci d'avoir dit " + rep.firstChild.data);
}