function allServError() {
    let l1 = document.getElementById("l1");
    let l2 = document.getElementById("l2");
    let u1 = document.getElementById("u1");
    let u2 = document.getElementById("u2");
    l1.innerHTML = "Ошибка сервера.";
    l2.innerHTML = "Ошибка сервера.";
    u1.innerHTML = "Список недоступен. Ошибка сервера.";
    u2.innerHTML = "Список недоступен. Ошибка сервера.";

}

function updateNowPlaying() {
    var xml = xmlParse();
    if (xml) {
        let mount = xml.getElementsByTagName("mount");
        let listeners = xml.getElementsByTagName("listeners");
        var users = xml.getElementsByTagName("users");
        if (mount) {
            if ((mount[0]) && (mount[0].firstChild)) {
                if (mount[0].firstChild.nodeValue == "/2050") {
                    let l = document.getElementById("l1");
                    let u = document.getElementById("u1")

                    update(users[0], listeners[0], u, l)

                    l = document.getElementById("l2");
                    u = document.getElementById("u2")

                    update(users[1], listeners[1], u, l)
                } else if (mount[0].firstChild.nodeValue == "/2051") {
                    let l = document.getElementById("l1");
                    let u = document.getElementById("u1")

                    update(users[1], listeners[1], u, l)

                    l = document.getElementById("l2");
                    u = document.getElementById("u2")

                    update(users[0], listeners[0], u, l)
                } else allServError();
            } else allServError();
        } else allServError();
    } else allServError();
}

function update(users, listeners, uNode, lNode) {
    if (users && listeners) {
        if (listeners) {
            if (listeners.firstChild) lNode.innerHTML = listeners.firstChild.nodeValue;
        } else lNode.innerHTML = "Ошибка сервера.";

        let usersList = [];
        if (users) {
            if (users.firstChild) {
                if (users.firstChild.nodeValue != "No users.") {
                    usersList = users.firstChild.nodeValue.split(", ");
                } else uNode.innerHTML = "На сервере никого нет.";
            } else uNode.innerHTML = "На сервере никого нет.";
        } else uNode.innerHTML = "Список недоступен. Ошибка сервера.";

        usersList = usersList.filter(function (ele) {
            return ele != "dj";
        });
        if (usersList.length > 0) {
            uNode.innerHTML = usersList.join(", ")
        } else uNode.innerHTML = "На сервере никого нет.";
    }
}

function xmlParse() {

    var xml = null;
    try {
        xml = getXMLDocument('/stream/status3.xsl');
        if (!xml) return;
    } catch (e) {
        return;
    }

    return xml;
}

function getXMLDocument(url) {
    var xml;
    if (window.XMLHttpRequest) {
        xml = new window.XMLHttpRequest();
        xml.open("GET", url, false);
        xml.send("");
        return xml.responseXML;
    } else if (window.ActiveXObject) {
        xml = new ActiveXObject("Microsoft.XMLDOM");
        xml.async = false;
        xml.load(url);
        return xml;
    } else {
        alert("Загрузка XML не поддерживается браузером");
        return null;
    }
}
