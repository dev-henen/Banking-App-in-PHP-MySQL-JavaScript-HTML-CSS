<?php

    final class Password_Hash
    {
        private $password;
        private $time_target;
        private $cost;
        private $plain;
        public $return;
        private $input;

        public function __construct($password_string)
        {
            $this->time_target = 0.05;
            $this->plain = $password_string;
            $this->input = $password_string;
        }

        public function do()
        {
            $cost = 8;
            do {
                ++$cost;
                $start = microtime(true);
                $this->password = password_hash(stripslashes($this->input), PASSWORD_BCRYPT, ['cost' => $cost]);
                $end = microtime(true);
            } while (($end - $start) < $this->time_target);

            return $this->password;
        }

        public function test()
        {
            $cost = 8;
            do {
                ++$cost;
                $start = microtime(true);
                if (password_needs_rehash($this->input, PASSWORD_BCRYPT, ['cost' => $cost])) {
                    return true;
                }
                $end = microtime(true);
            } while (($end - $start) < $this->time_target);

            return false;
        }

        public function verify(string $hash)
        {
            if (password_verify($this->plain, $hash)) {
                return true;
            }

            return false;
        }
    }
