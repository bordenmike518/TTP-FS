function popoutMenu() {
    var menu = document.getElementById("hamburgerMenu");
    var links = document.getElementsByClassName("hamburgerLink");
    var dimmer = document.getElementById("dimmer");
    if (menu.style.width == "250px") {
        dimmer.setAttribute("style",
            "visibility: hidden; \
             width: 0px;");
        menu.setAttribute("style",
            "visibility: hidden; \
             width: 0px;");
        for (var j = 0; j <= links.length-1; j++)
            links[j].setAttribute("style", 
                "width: 0px; \
                visibility: hidden;");
    }
    else {
        dimmer.setAttribute("style",
            "visibility: visible; \
             width: 100%;");
        for (var j = 0; j <= links.length-1; j++)
            links[j].setAttribute("style", 
                "width:220px; \
                visibility:visible;");
        menu.setAttribute("style",
            "visibility: visible; \
             width: 250px;");
    }
}

function mouseOverLink(element) {
    let elem = element.children["childLink"];
    var text = elem.textContent;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext('2d');
    var width = context.measureText(text).width;
    elem.style.width = Math.floor(width * 3 + 15) + "px";
}

function mouseOutLink(element) {
    var elem = element.children["childLink"];
    elem.style.width = "220px";
}

function goToLink(link) {
    window.location = link;
}
