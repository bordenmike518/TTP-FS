function listTransactions() {
    var stocks = ["AAPL", "GOOG", "NFLX", "MSFT", "AAPL", "GOOG", "FB", "JPM", "MMM", "CAT", "DOW", "IBM", "INTC", "GOOG", "BA", "AXP", "JNJ"];
    var main = document.getElementsByTagName("main")[0];
    var stockBox = " \
        <div class='infoBox'> \
            <div id='moreInfoArrow'>&#9660</div> \
            <p id='stockInfo'>{1}</p> \
        </div>";
    for (var i = 0; i < stocks.length; i++) {
        main.insertAdjacentHTML("afterbegin", stockBox.format((120 * (i+1)), stocks[i]));
    }
}
