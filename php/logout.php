<?php
    include("EZDB.php");
    ini_set('display_errors', '1');
    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    if (isset($_GET["logout"])) {
        echo print_r($_SESSION, TRUE);
        $ezdb = $_SESSION["ezdb"];
        $ezdb->logout();
    }
    else {
        echo "not working!!";
    }
?>