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

String.prototype.format = function () {
        var args = [].slice.call(arguments);
        return this.replace(/(\{\d+\})/g, function (a){
            return args[+(a.substr(1,a.length-2))||0];
        });
};

function listPortfolio() {
    var stocks = ["AAPL", "STWD", "NFLX", "MSFT", "ATT", "GOOG", "FB", "JPM", "MMM", "CAT", "DOW", "IBM", "INTC", "CSCO", "BA", "AXP", "JNJ"];
    var main = document.getElementsByTagName("main")[0];
    console.log(main);
    var stockBox = " \
        <div class='infoBox'> \
            <div id='moreInfoArrow'>&#9660</div> \
            <p id='stockInfo'>{1}</p> \
        </div>";
    for (var i = 0; i < stocks.length; i++) {
        main.insertAdjacentHTML("afterbegin", stockBox.format((120 * (i+1)), stocks[i]));
    }
}

function check() {
    $check = document.getElementById('check');
    $check.click();
}
