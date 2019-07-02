<?php
    require_once "config.php";

    if(isset($_GET['logout'])) {
        $ezdb->logout();
    }
?>