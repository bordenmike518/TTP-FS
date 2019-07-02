<?php

    include("EZDB.php");
    ini_set('display_errors', '1');

    if(!isset($_SESSION)) { 
        session_start();
    }

    if(!isset($ezdb)) {
        $ezdb = new EZDB('localhost', 'postgres', 'postgres', 'adm123') or die("Couldn't make connection to database.");
        $ezdb->connect();
    }

?>