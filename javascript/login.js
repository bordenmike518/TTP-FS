/*document.addEventListener('invalid', (function(){
    return function(e){
        e.preventDefault();
        e["target"].style.borderWidth = "2px";
        e["target"].style.marginBottom = "9px";
        e["target"].style.borderColor = "#f00";
    };
})(), true);

document.addEventListener('valid', (function(){
    return function(e){
        e.preventDefault();
        e["target"].style.borderWidth = "1px";
        e["target"].style.marginBottom = "10px";
        e["target"].style.borderColor = "#666";
    };
})(), true);*/

function showPassword() {
    var x = document.getElementsByClassName("showPassword");
    for(var i = 0; i < x.length; i++) {
        if (x[i].type === "password")
            x[i].type = "text";
        else
            x[i].type = "password";
    }
}

function validateConfirmedPassword() {
    console.log('run');
    var pwd1 = document.getElementsByName("password")[0];
    var pwd2 = document.getElementsByName("repassword")[0];
    var submit = document.getElementById("registerSubmit");
    console.log(pwd1.value);
    console.log(pwd2.value);
    if (pwd1.value != pwd2.value) {
        pwd2.placeholder = "Passwords don't match";
        pwd2.value = "";
        pwd2.style.borderColor = "#f00";
        pwd2.focus();
        console.log('not match');
    }
    else {
        console.log('match');
        submit.click();
    }
}

function uncheck () {
    var checkbox = document.getElementById('showId');
    checkbox.checked = false;
}
