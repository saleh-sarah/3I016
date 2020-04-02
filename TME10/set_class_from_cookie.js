var re_cookie = / *([\w\-_]+)=([^;]+) */;
	
function set_class_from_cookie(){
    document.cookie.split(';').foreach(function (c) {
	var r = re_cookie.exec(c);
        if (r) {
	    var n = document.getElementById(r[1]);
	    if (n) n.className = r[2];
	    document.cookie = r[1] + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
	}
    }
}