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
        private $registerQuery1  = "insert into users (fname, lname, email, password, timstamp) values ($1, $2, $3, $4, now());";
        private $registerQuery2  = "select userid from users where email = $1;";
        private $loginQuery      = "select userId, password from users where email = $1;";
        private $logSheetQuery   = "insert into logSheet (userId, type, timstamp) values ($1, $2, now());";
        private $checkLoginQuery = "select sum(case type when 'I' then 1 when 'O' then -1 end) from logSheet where userId = $1";
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
            pg_prepare($this->conn, "login", $this->loginQuery);
            pg_prepare($this->conn, "logSheet", $this->logSheetQuery);
            pg_prepare($this->conn, "register1", $this->registerQuery1);
            pg_prepare($this->conn, "register2", $this->registerQuery2);
            pg_prepare($this->conn, "checkLogin", $this->checkLoginQuery);
        }

        public function register ($fname, $lname, $email, $password) {
            try {
                unset($_SESSION['loginError']);
                unset($_SESSION['lastFname']);
                unset($_SESSION['lastLname']);
                $hash  = password_hash($password, PASSWORD_DEFAULT);
                pg_execute($this->conn, "register1", array("$fname", "$lname", "$email", "$hash"));
                $result = pg_execute($this->conn, "register2", array("$email"));
                $id = pg_fetch_result($result, 0, 0);
                $_SESSION['id'] = $id;
                $_SESSION['timestamp'] = time();
                pg_execute($this->conn, "logSheet", array("$id", "I"));
                $this->close();
                header("Location: portfolio.php");
            } catch (Exception $e) {
                $this->close();
                $_SESSION['loginError'] = true;
                $_SESSION['lastFname'] = $fname;
                $_SESSION['lastLname'] = $lname;
            }
        }
        
        public function login ($email, $password) {
            try {
                unset($_SESSION['loginError']);
                unset($_SESSION['lastEmail']);
                unset($_SESSION['inuseError']);
                $result = pg_execute($this->conn, "login", array("$email"));
                $id = pg_fetch_result($result, 0, 0);
                $hash = pg_fetch_result($result, 0, 1);
                if (password_verify($password, $hash)) {
                    $_SESSION['id'] = $id;
                    if($this->checkLogin()) {
                        unset($_SESSION['id']);
                        $this->close();
                        $_SESSION['inuseError'] = true;
                        header('Location: login.php');
                    }
                    $_SESSION['timestamp'] = time();
                    pg_execute($this->conn, "logSheet", array("$id", "I"));
                    $this->close();
                    header('Location: portfolio.php');
                }
                else {
                    $this->close();
                    $_SESSION['loginError'] = true; 
                    $_SESSION['lastEmail'] = $email;
                    header('Location: login.php');
                }
            } catch (Exception $e) {
                $this->close();
                $_SESSION['loginError'] = true; 
                $_SESSION['lastEmail'] = $email;
                header('Location: login.php');
            }
        }

        public function checkLogin() {
            try {
                $id = $_SESSION['id'];
                $result = pg_execute($this->conn, "checkLogin", array("$id"));
                $result = intval(pg_fetch_result($result, 0, 0));
                if ($result == 1) {
                    return true;
                }
                else {
                    return false;
                }
            } catch (Exception $e) {
                header('Location: ../html/404.html');
            }
        }
        
        public function logout () {
            try {
                $id = $_SESSION['id'];
                pg_execute($this->conn, "logSheet", array("$id", "O"));
                $this->close();
                session_unset();
                session_destroy();
                header("Location: login.php");
                exit();
            } catch (Exception $e) {
                header('Location: ../html/404.html');
            }
        }

        private function close () {
            pg_close($this->conn);
        }
    }

?>
