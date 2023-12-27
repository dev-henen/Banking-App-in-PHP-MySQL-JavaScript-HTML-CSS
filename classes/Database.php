<?php
    namespace mysql;

    use mysqli;
    use Exception;

    final class Database {
        private $host;
        private $username;
        private $password;
        private $databse_name;
        private $connection;
        private $mysqli;

        public function __construct($host, $username, $password, $databse_name = null) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->databse_name = $databse_name;
        }

        public final function connect() {
            try {

                $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->databse_name);
                if(!$this->mysqli) {
                    throw new Exception("Could not connect to database");
                }

            } catch(Exception $e) {
                http_response_code(500);
                die($e->getMessage());
            }
        }

        public final function get() {
            return $this->mysqli;
        }

        public function __destruct()
        {
            if($this->mysqli) {
                $this->mysqli->close();
            }
        }
    }
