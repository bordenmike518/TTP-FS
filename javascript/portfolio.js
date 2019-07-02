
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
