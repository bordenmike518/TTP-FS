<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    if(isset($_SESSION['id'])) {
        header("Location: portfolio.php");
        exit();
    }
    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign In</title>
<meta charset="utf-8">
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/login.css">
<script type="text/javascript" src="../javascript/login.js"></script>
</head>
<body onload="uncheck();">
    <header></header>
    <nav></nav>
    <main>
        <div class="loginbox" style="height: 280px;">
            <img src="../images/avatar.png" class="avatar" style="top: calc(-50% + 145px);">
            <h1>Sign In</h1>
            <form id="loginForm" name="loginForm" autocomplete="on" action="loginForm.php" method="POST">
                <input type="text" name="email" placeholder="E-mail" required autofocus>
                <input type="password" class="showPassword" name="password" placeholder="Password" required>
                <label for="showId" > <input type="checkbox" id="showId" onclick="showPassword()"> Show password </label>
                <input type="button" value="Login" onclick="document.getElementById('registerSubmit').click();">
                <input type="submit" id="registerSubmit">
                <br><br>
                <a href="register.php">Don't have an account?</a><br><br>
                <a href="#">Forgot your password?</a>
            </form>
        </div>
    </main>
    <footer><i>Copyright &copy; 2019 Michael Borden</i></footer>
</body>
</html>
<?php
    }
?>