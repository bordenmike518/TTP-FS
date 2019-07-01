<?php
    include("EZDB.php");
    ini_set('display_errors', '1');
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    
    $ezdb = new EZDB('localhost', 'postgres', 'postgres', 'adm123');
    $ezdb->{'connect'}();

    if (isset($_POST['fname'])) {
        $fname     = $_POST['fname'];
        $lname     = $_POST['lname'];
        $email     = $_POST['email'];
        $password  = $_POST['password'];
        $result = $ezdb->{'register'}($fname, $lname, $email, $password);
        if ($result) {
            $_SESSION["ezdb"] = $ezdb;
            header("Location: ../html/portfolio.html");
        }
        else {
            header("Location: ../html/register.html");
        }
    }
?>
