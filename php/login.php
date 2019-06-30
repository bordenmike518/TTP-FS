<?php

    include("EZDB.php");
    ini_set('display_errors', 1);
    
    $ezdb = new EZDB('localhost', 'postgres', 'postgres', 'adm123');
    $ezdb->{'DBConn'}();
    $conn = $ezdb->{'conn'};

    if (isset($_POST['email'])) {
        $email  = $_POST['email'];
        $passw  = $_POST['password'];
        $query  = "select *
                   from users
                   where email = $1;";
        $result = pg_prepare($conn, "login", $query);
        $result = pg_execute($conn, "login", array("$email"));
        echo $result;
        $arr = pg_fetch_result($result, 0, 0);
        echo $arr;
        echo $arr["password"];
        if (password_verify($passw, $arr["password"])) {
            $ezdb->DBClose();
            //header("Location: ../html/portfolio.html");
        }
        else {
            $ezdb->DBClose();
            //header("Location: ../html/register.html");
        }
    }
?>
