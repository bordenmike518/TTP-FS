<?php
    require_once "config.php";

    if (isset($_POST['email'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $result = $ezdb->login($email, $password);
        if ($result) {
            header("Location: portfolio.php");
            exit();
        }
        else {
            echo $result;
            //header("Location: login.php");
            exit();
        }
    }
?>