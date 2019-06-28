function popoutMenu() {
    var menu = document.getElementsByClassName("hamburgerMenu")[0];
    var links = document.getElementsByClassName("hamburgerLink");
    if (menu.style.width == "200px") {
        menu.setAttribute("style",
            "visibility: hidden; \
             width: 0px;");
        for (var j = 0; j <= links.length-1; j++)
            links[j].setAttribute("style", "width: 0px; visibility: hidden;");
    }
    else {
        for (var j = 0; j <= links.length-1; j++)
            links[j].setAttribute("style", "width:168px; visibility:visible;");
        menu.setAttribute("style",
            "visibility: visible; \
             width: 200px;");
    }
}

function mouseOverLink(element) {
    let elem = element.children[0];
    var text = elem.textContent;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext('2d');
    var width = context.measureText(text).width;
    var ds = Math.floor(width * 2 + 15);
    elem.style.width = ds + "px";
}

function mouseOutLink(element) {
    elem = element.children[0];
    elem.style.width = "168px";
}

function goToLink(link) {
    window.location = link;
}
