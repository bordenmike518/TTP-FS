var request = new XMLHttpRequest();

window.onload=function() {
    var ticker = document.getElementById('liveTicker');
    ticker.addEventListener('DOMSubtreeModified', updateName);
}

String.prototype.format = function () {
        var args = [].slice.call(arguments);
        return this.replace(/(\{\d+\})/g, function (a){
            return args[+(a.substr(1,a.length-2))||0];
        });
};

function clearText() {
    var ticker = document.getElementById('liveTicker');
    ticker.innerText = '';
}

function getTickerData () {
    var input = document.getElementById('liveInput').value.trim();
    var ticker = document.getElementById('liveTicker');
    var price = document.getElementById('livePrice');
    if (input.length == 0) { 
        ticker.innerText = '';
        price.innerText = '0.00'; 
        return;
    }
    input = input.toUpperCase();
    request.open('GET', 'https://api.iextrading.com/1.0/tops');
    request.send();
    request.onreadystatechange = (function(e) {
        return function () {
            if (request.readyState == 4) {
                data = JSON.parse(request.responseText);
                data.sort(function(a,b){
                    if(a.symbol == b.symbol) return 0;
                    if(a.symbol < b.symbol) return -1;
                    if(a.symbol > b.symbol) return 1;
                });
                var found = false;
                var tic = '';
                var prc = '0.00';
                var mxVolume = 0;
                for (i = 0; i < data.length; i++) {
                    if (data[i].symbol.slice(0, input.length) == input) {
                        if (data[i].volume > mxVolume) {
                            tic = data[i].symbol;
                            prc = Number.parseFloat(data[i].lastSalePrice).toFixed(2);
                            if(data[i].symbol.length == input.length) {
                                break;
                            }
                            mxVolume = data[i].volume;
                        }
                        found = true;
                    }
                    else {
                        if (found) {
                            break;
                        }
                    }
                }
                ticker.innerText = tic;
                price.innerText  = prc;
            }
        }
    })(request);
}

function updateName() {
    var ticker = document.getElementById('liveTicker').innerText;
    var name = document.getElementById('liveName');
    request.open('GET', 'https://api.iextrading.com/1.0/ref-data/symbols');
    request.send();
    request.onreadystatechange = (function(e) {
        return function () {
            if (request.readyState == 4) {
                data = JSON.parse(request.responseText);
                var cmp = ''
                var found = false;
                for (i = 0; i < data.length; i++) {
                    if (data[i].symbol == ticker && ticker.length != 0) {
                        if (name.innerText != data[i].name) {
                            console.log(name.innerText)
                            console.log(cmp)
                            name.innerText = data[i].name;
                        }
                        found = true;
                        break;
                    }
                }
                if (!found) {name.innerText = '';}
            }
        }
    })(request);
}