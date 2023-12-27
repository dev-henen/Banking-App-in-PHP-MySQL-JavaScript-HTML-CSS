<?php

    class History {
        private $customer_id;
        private $body;
        private $connection;
        public function __construct($connection)
        {
            $this->connection = $connection;
        }
        public function __destruct()
        {
            if($this->connection) {
                $this->connection->close();
            }
        }
        public function set_customer_id($id) {
            $this->customer_id = $id;
        }
        public function set_body($body) {
            $this->body = $body;
        }
        public function save(): bool {
            if(empty($this->customer_id) || empty($this->body)) {
                return false;
            }
            $v1 = $v2 = null;
            $sql = "INSERT INTO bank_history(`CustomerID`, `Body`) VALUES(?, ?);";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('is', $v1, $v2);
            $v1 = $this->customer_id;
            $v2 = $this->body;
            if($stmt->execute()) {
                return true;
            }
            $stmt->close();
            return false;
        }
    }