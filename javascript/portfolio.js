
String.prototype.format = function () {
        var args = [].slice.call(arguments);
        return this.replace(/(\{\d+\})/g, function (a){
            return args[+(a.substr(1,a.length-2))||0];
        });
};

function getLiveTicker(evt) {
    document.getElementById('liveTicker').submit();
}

document.getElementById("liveTicker").addEventListener("keyup", getLiveTicker, false);