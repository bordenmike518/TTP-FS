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
<title>Register</title>
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
        <div class="loginbox" style="height: 400px;">
            <img src="../images/avatar.png" class="avatar" style="top: calc(-50% + 200px);">
            <h1>Register</h1>
            <form id="registerForm" autocomplete="on" name="registerForm" action="registerForm.php" method="POST">
                <input type="text" name="fname" placeholder="First name" maxlength="64" required>
                <input type="text" name="lname" placeholder="Last name" maxlength="64" required>
                <input type="email" name="email" placeholder="E-mail" maxlength="64" required>
                <input type="password" class="showPassword" name="password" placeholder="Password" value="" maxlength="64" required>
                <input type="password" class="showPassword" name="repassword" placeholder="Confirm password" value="" maxlength="64" required>
                <label for="showId" > <input type="checkbox" id="showId" onclick="showPassword()"> Show password </label>
                <input type="button" value="Login" onclick="validateConfirmedPassword();">
                <input type="submit" id="registerSubmit">
                <br><br>
                <a href="login.php">Already have an account?</a><br><br>
            </form>
        </div>
    </main>
    <footer><i>Copyright &copy; 2019 Michael Borden</i></footer>
</body>
</html>
<?php
    }
?>
