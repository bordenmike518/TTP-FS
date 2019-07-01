<?php
    include("EZDB.php");
    ini_set('display_errors', '1');
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    
    $ezdb = new EZDB('localhost', 'postgres', 'postgres', 'adm123');
    $ezdb->connect();

    if (isset($_POST['email'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $result = $ezdb->login($email, $password);
        if ($result) {
            $_SESSION["ezdb"] = $ezdb;
            header("Location: ../html/portfolio.html");
        }
        else {
            echo $result;
            header("Location: ../html/login.html");
        }
    }
?>
