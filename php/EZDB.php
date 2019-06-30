<?php

    function exception_error_handler($errno, $errstr, $errfile, $errline ) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
    set_error_handler("exception_error_handler");

    class EZDB {
        var $host   = "";
        var $user   = "";
        var $pass   = "";
        var $dbname = "";

        public $conn;
        
        function EZDB ($host, $dbname, $user, $pass) {
            $this->host   = $host;
            $this->user   = $user;
            $this->pass   = $pass;
            $this->dbname = $dbname;
        }

        function DBConn () {
            $this->conn = pg_connect("host=$this->host port=5432 dbname=$this->dbname user=$this->user password=$this->pass");
        }

        function DBClose () {
            pg_close($this->conn);
        }
    }

?>
