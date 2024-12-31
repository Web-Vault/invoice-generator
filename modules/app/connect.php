<?php

class connect
{
        private $hostname;
        private $username;
        private $password;
        private $database;
        private $conn;

        function __construct()
        {
                $this->hostname = "localhost";
                $this->username = "root";
                $this->password = "";
                $this->database = "invoice";
        }

        public function connect_db()
        {
                $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);

                if ($this->conn->connect_error) {
                        die("Connection failed: " . $this->conn->connect_error);
                } else {
                        // echo "Successfully connected";  
                }

                return $this->conn;
        }
}

$connect = new connect();
$db = $connect->connect_db();

?>