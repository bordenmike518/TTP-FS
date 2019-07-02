function popoutMenu() {
    var menu = document.getElementById("hamburgerMenu");
    var links = document.getElementsByClassName("hamburgerLink");
    var dimmer = document.getElementById("dimmer");
    if (menu.style.width == "200px") {
        dimmer.setAttribute("style",
            "visibility: hidden; \
             width: 0px;");
        menu.setAttribute("style",
            "visibility: hidden; \
             width: 0px;");
        for (var j = 0; j <= links.length-1; j++)
            links[j].setAttribute("style", "width: 0px; visibility: hidden;");
    }
    else {
        dimmer.setAttribute("style",
            "visibility: visible; \
             width: 100%;");
        for (var j = 0; j <= links.length-1; j++)
            links[j].setAttribute("style", "width:168px; visibility:visible;");
        menu.setAttribute("style",
            "visibility: visible; \
             width: 200px;");
    }
}

function mouseOverLink(element) {
    let elem = element.children["childLink"];
    var text = elem.textContent;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext('2d');
    var width = context.measureText(text).width;
    var ds = Math.floor(width * 2 + 15);
    elem.style.width = ds + "px";
}

function mouseOutLink(element) {
    var elem = element.children["childLink"];
    elem.style.width = "160px";
}

function goToLink(link) {
    window.location = link;
}
