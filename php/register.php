<?php

    include("EZDB.php");
    ini_set('display_errors', 1);
    
    $ezdb = new EZDB('localhost', 'postgres', 'postgres', 'adm123');
    $ezdb->{'DBConn'}();
    $conn = $ezdb->{'conn'};

    if (isset($_POST['fname'])) {
        $fname  = $_POST['fname'];
        $lname  = $_POST['lname'];
        $email  = $_POST['email'];
        $passw  = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query  = "insert into users (fname, lname, email, password, timstamp)
                   values ($1, $2, $3, $4, now());";
        $result = pg_prepare($conn, "register", $query);
        $result = pg_execute($conn, "register", array("$fname", "$lname", "$email", "$passw"));
        if ($result) {
            $ezdb->DBClose();
            header("Location: ../html/portfolio.html");
        }
        else {
            $ezdb->DBClose();
            header("Location: ../html/register.html");
        }
    }
?>
