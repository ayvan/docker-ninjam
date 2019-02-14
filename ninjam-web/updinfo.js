function allServError(){
    var l1 = document.getElementById("l1");
    var l2 = document.getElementById("l2");
    var u1 = document.getElementById("u1");
    var u2 = document.getElementById("u2");
    l1.innerHTML = "Ошибка сервера.";
    l2.innerHTML = "Ошибка сервера.";
    u1.innerHTML = "Список недоступен. Ошибка сервера.";            
    u2.innerHTML = "Список недоступен. Ошибка сервера.";            

}

function updateNowPlaying() {
var xml=xmlParse();
if (xml){
    var mount=xml.getElementsByTagName("mount");
    var listeners=xml.getElementsByTagName("listeners");
    var users=xml.getElementsByTagName("users");
    if(mount){
	if((mount[0])&&(mount[0].firstChild)){
	    if(mount[0].firstChild.nodeValue=="/2050"){
    		if(users&&listeners){
        	    var l1 = document.getElementById("l1");
        	    var l2 = document.getElementById("l2");
        	    var u1 = document.getElementById("u1");
        	    var u2 = document.getElementById("u2");
        	    if(listeners[0]){
        	        if(listeners[0].firstChild) l1.innerHTML = listeners[0].firstChild.nodeValue;
    		    }
    		    else l1.innerHTML = "Ошибка сервера.";
        	    if(listeners[1]){
        	        if(listeners[1].firstChild) l2.innerHTML = listeners[1].firstChild.nodeValue;
    		    }
    		    else l2.innerHTML = "Ошибка сервера.";    	
        	    if(users[0]){
        	        if (users[0].firstChild){
        		    if(users[0].firstChild.nodeValue!="No users."){
            			u1.innerHTML = users[0].firstChild.nodeValue
			    }
        		    else u1.innerHTML = "На сервере никого нет.";
        		}
        		else u1.innerHTML = "На сервере никого нет.";
    		    }
        	    else u1.innerHTML = "Список недоступен. Ошибка сервера.";
        	    if(users[1]){
        		if (users[1].firstChild){
        		    if(users[1].firstChild.nodeValue!="No users."){
        			u2.innerHTML = users[1].firstChild.nodeValue
        		    }
        		    else u2.innerHTML = "На сервере никого нет.";
        		}
        		else u2.innerHTML = "На сервере никого нет.";
    		    }
    		    else u2.innerHTML = "Список недоступен. Ошибка сервера.";
		}
	    }
	    else if(mount[0].firstChild.nodeValue=="/2051"){
    		if(users&&listeners){
        	    var l1 = document.getElementById("l1");
        	    var l2 = document.getElementById("l2");
        	    var u1 = document.getElementById("u1");
        	    var u2 = document.getElementById("u2");
        	    if(listeners[0]){
        		if(listeners[0].firstChild) l2.innerHTML = listeners[0].firstChild.nodeValue;
    		    }
    		    else l2.innerHTML = "Ошибка сервера.";
    		    l1.innerHTML = "Ошибка сервера.";
    		    if(users[0]){
        		if (users[0].firstChild){
        		    if(users[0].firstChild.nodeValue!="No users."){
            			u2.innerHTML = users[0].firstChild.nodeValue
			    }
        		    else u2.innerHTML = "На сервере никого нет.";
        		}
    		    }
        	    else u2.innerHTML = "Ошибка сервера.";
        	    u1.innerHTML = "Список недоступен. Ошибка сервера.";            
		}
    
	    }
	    else allServError();
	}
	else allServError();
    }
    else allServError();
}
else allServError();
}

function xmlParse(){

    var xml=null;
    try {
	xml=getXMLDocument('/stream/status3.xsl');
        if(!xml) return;
    }
    catch(e){
        return;
    }

    return xml;
}

function getXMLDocument(url){
    var xml;
    if(window.XMLHttpRequest)
    {
        xml=new window.XMLHttpRequest();
        xml.open("GET", url, false);
        xml.send("");
        return xml.responseXML;
    }
    else
        if(window.ActiveXObject)
        {
            xml=new ActiveXObject("Microsoft.XMLDOM");
            xml.async=false;
            xml.load(url);
            return xml;
        }
        else
        {
            alert("Загрузка XML не поддерживается браузером");
            return null;
        }
}

function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

function updAllUsers(){
//updAllUsers1();
//updAllUsers2();
}

function updAllUsers1(){
    var xmlhttp = getXmlHttp();
    xmlhttp.open('GET', '/allusers.php', true);
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
         if(xmlhttp.status == 200) {
            var alu1 = document.getElementById("allusers1");
            if(alu1) alu1.innerHTML = xmlhttp.responseText;
         }
      }
    };
    xmlhttp.send(null);
}

function updAllUsers2(){
    var xmlhttp = getXmlHttp();
    xmlhttp.open('GET', '/allusers2.php', true);
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
         if(xmlhttp.status == 200) {
            var alu2 = document.getElementById("allusers2");
            if(alu2) alu2.innerHTML = xmlhttp.responseText;
         }
      }
    };
    xmlhttp.send(null);
}
