<?php

    final class Inc {

        public static function use(String $inc_name, $bank_login_link = null, array $params = null, $connection = null) {
            if(file_exists(APP_BASE . 'inc/' . $inc_name . '.php')) {
                $is_inc = 111000110043543513;
                include APP_BASE . 'inc/' . $inc_name . '.php';
            } else {
                echo '<i><mark>Could not find ' . $inc_name . ' include</mark></i>';
            }
        }

    }