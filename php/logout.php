<?php
    include("config.php");

    if(isset($_GET['logout'])) {
        $ezdb->logout();
    }
?>