<?php
    require_once 'config.php';

    if ( (isset($_SESSION['loginError']) or isset($_SESSION['inuseError']))) {
    }

    if (isset($_POST['email'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $ezdb->login($email, $password);
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
<link rel="stylesheet" type="text/css" href="../css/login.css">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script type="text/javascript" src="../javascript/login.js"></script>
</head>
<body onload="uncheck();">
    <header></header>
    <nav></nav>
    <main>
        <?php if(isset($_SESSION['loginError']) or isset($_SESSION['inuseError'])) { ?>
            <div class="loginbox" id="loginError" style="height: 280px;">
        <?php } else { ?>
            <div class="loginbox" style="height: 280px;">
        <?php } ?>
            <img src="../images/avatar.png" class="avatar" style="top: calc(-50% + 145px);">
            <h1>Sign In</h1>
            <form id="loginForm" name="loginForm" autocomplete="on" action="#" method="POST">
                <?php if(!isset($_POST['email']) and isset($_SESSION['loginError'])) { ?>
                    <input type="text" name="email" value="<?= $_SESSION['lastEmail']; ?>" maxlength="64" required>
                    <input type="password" class="showPassword" name="password" placeholder="Email or password incorrect." maxlength="64" required autofocus>
                <?php 
                    session_unset();
                    session_destroy();
                } elseif (!isset($_POST['email']) and isset($_SESSION['inuseError'])) { ?>
                    <input type="text" name="email" placeholder="Email already signed in." maxlength="64" required autofocus>
                    <input type="password" class="showPassword" name="password" placeholder="Password" maxlength="64" required>
                <?php 
                    session_unset();
                    session_destroy();
                } else { ?>
                    <input type="text" name="email" placeholder="Email" maxlength="64" required autofocus>
                    <input type="password" class="showPassword" name="password" placeholder="Password" maxlength="64" required>
                <?php
                    }
                ?>
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
    /*if (isset($_SESSION['loginError']) or isset($_SESSION['inuseError'])) {
        session_unset();
        session_destroy();
    }*/
?>