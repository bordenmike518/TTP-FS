<?php
    include('config.php');

    if (isset($_POST['email'])) {
        $fname     = $_POST['fname'];
        $lname     = $_POST['lname'];
        $email     = $_POST['email'];
        $password  = $_POST['password'];
        $ezdb->register($fname, $lname, $email, $password);
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
        <?php if(!isset($_SESSION['loginError'])) { ?>
            <div class="loginbox" style="height: 400px;">
        <?php } else { ?>
            <div class="loginbox" id="loginError" style="height: 400px;">
        <?php } ?>
            <img src="../images/avatar.png" class="avatar" style="top: calc(-50% + 200px);">
            <h1>Register</h1>
            <form id="registerForm" autocomplete="on" name="registerForm" action="#" method="POST">
                <?php if(!isset($_POST['email']) and !isset($_SESSION['loginError'])) { 
                ?>
                    <input type="text" name="fname" placeholder="First name" maxlength="64" required>
                    <input type="text" name="lname" placeholder="Last name" maxlength="64" required>
                    <input type="email" name="email" placeholder="Email" maxlength="64" required>
                <?php 
                } else { ?>
                    <input type="text" name="fname" value="<?= ucwords($_SESSION['lastFname']); ?>" maxlength="64" required>
                    <input type="text" name="lname" value="<?= ucwords($_SESSION['lastLname']); ?>" maxlength="64" required>
                    <input type="email" name="email" placeholder="That email is already taken." maxlength="64" required>
                <?php 
                    session_unset();
                    session_destroy();
                    }
                    session_unset();
                    session_destroy();
                ?>
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
<script>
    if(window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>
<?php
    }
    if (isset($_SESSION['loginError'])) {
        session_unset();
        session_destroy();
    }
?>
