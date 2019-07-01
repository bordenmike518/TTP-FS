<?php
    require_once "config.php";

    if (isset($_POST['fname'])) {
        $fname     = $_POST['fname'];
        $lname     = $_POST['lname'];
        $email     = $_POST['email'];
        $password  = $_POST['password'];
        $result = $ezdb->{'register'}($fname, $lname, $email, $password);
        if ($result) {
            header("Location: portfolio.php");
            exit();
        }
        else {
            header("Location: register.php");
            exit();
        }
    }

?>