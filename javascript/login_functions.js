function showPassword() {
    var x = document.getElementsByClassName("showPassword");
    for(var i = 0; i < x.length; i++) {
        if (x[i].type === "password")
            x[i].type = "text";
        else
            x[i].type = "password";
    }
}

function checkPasswordMatch() {
    pwd1 = document.getElementByName("password");
    pwd2 = document.getElementByName("repassword");
    if (pwd1 != pwd2)
        alert("YUP!");
    else
        alert("YUP!");
}
