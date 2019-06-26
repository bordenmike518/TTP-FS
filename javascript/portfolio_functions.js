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
            links[j].setAttribute("style", "width: auto; visibility: visible;");
        menu.setAttribute("style",
            "visibility: visible; \
             width: 200px;");
    }
}
