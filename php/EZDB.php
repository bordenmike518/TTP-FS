<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    function exception_error_handler($errno, $errstr, $errfile, $errline ) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
    set_error_handler("exception_error_handler");

    class EZDB {
        private $host   = "";
        private $user   = "";
        private $pass   = "";
        private $dbname = "";
        private $registerQuery  = "insert into users (fname, lname, email, password, timstamp) values ($1, $2, $3, $4, now()); select userid from users where email = $3;";
        private $loginQuery     = "select userId, password from users where email = $1;";
        private $logSheetQuery  = "insert into logSheet (userId, type, timstamp) values ($1, $2, now());";
        private $conn;
        
        public function EZDB ($host, $dbname, $user, $pass) {
            $this->host   = $host;
            $this->user   = $user;
            $this->pass   = $pass;
            $this->dbname = $dbname;
        }

        public function connect () {
            $this->conn = pg_connect("host=$this->host port=5432 dbname=$this->dbname user=$this->user password=$this->pass") or die("Failed to connect to database!");
            $this->pass = "";
        }

        public function register ($fname, $lname, $email, $password) {
            try {
                $hash  = password_hash($password, PASSWORD_DEFAULT);
                $result = pg_prepare($this->conn, "register", $this->registerQuery);
                $result = pg_execute($this->conn, "register", array("$fname", "$lname", "$email", "$hash"));
                $id = pg_fetch_result($result, 0, 0);
                if ($result) {
                    $_SESSION['id'] = $id;
                    $result = pg_prepare($this->conn, "logSheet", $this->logSheetQuery);
                    $result = pg_execute($this->conn, "logSheet", array("$id", "I"));
                    $this->close();
                    return true;
                }
                else {
                    $this->close();
                    return false;
                }
            } catch (Exception $e) {
                $this->close();
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        
        public function login ($email, $password) {
            try {
                $result = pg_prepare($this->conn, "login", $this->loginQuery);
                $result = pg_execute($this->conn, "login", array("$email"));
                $id = pg_fetch_result($result, 0, 0);
                $hash = pg_fetch_result($result, 0, 1);
                if (password_verify($password, $hash)) {
                    $_SESSION['id'] = $id;
                    $result = pg_prepare($this->conn, "logSheet", $this->logSheetQuery);
                    $result = pg_execute($this->conn, "logSheet", array("$id", "I"));
                    $this->close();
                    return true;
                }
                else {
                    $this->close();
                    return false;
                }
            } catch (Exception $e) {
                $this->close();
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        
        public function logout () {
                $id = $_SESSION['id'];
                $result = pg_prepare($this->conn, "logSheet", $this->logSheetQuery);
                $result = pg_execute($this->conn, "logSheet", array("$id", "O"));
                $this->close();
                unset($_SESSION['id']);
                header("Location: login.php");
                exit();
        }

        private function close () {
            pg_close($this->conn);
        }
    }

?>
