<?php

    function check_device() {
        $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
        if(is_numeric(strpos($ua, 'mobile'))) {
            return 'mobile';
        } elseif(is_numeric(strpos($ua, 'tablet'))) {
            return 'tablet';
        }
        return 'desktop';
    }

    if(!defined("APP_NAME")) define("APP_NAME", 'BankProject');
    if(!defined("APP_BASE")) define("APP_BASE", $_SERVER["DOCUMENT_ROOT"] . '/');

    //Databse configuration
    if(!defined("DATABASE_HOST")) define("DATABASE_HOST", 'your_database_host'); //Database server
    if(!defined("DATABASE_USERNAME")) define("DATABASE_USERNAME", 'your_database_username'); //Database username
    if(!defined("DATABASE_PASSWORD")) define("DATABASE_PASSWORD", 'your_database_password'); //Database password
    if(!defined("DATABASE_NAME")) define("DATABASE_NAME", 'your_database_name'); //Database name

    if(!defined("HOST_SCHEME")) define("HOST_SCHEME", (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "ON")? 'https' : 'http');
    if(!defined("HOST_NAME")) define("HOST_NAME", str_replace('/', '', $_SERVER["HTTP_HOST"]));
    if(!function_exists('HOST_ROOT')) { function HOST_ROOT() { echo HOST_SCHEME . '://' . HOST_NAME . '/'; } }
    if(!function_exists('GET_HOST_ROOT')) { function GET_HOST_ROOT() { return HOST_SCHEME . '://' . HOST_NAME . '/'; } }
    if(!defined("DEVICE")) define("DEVICE", check_device());
    if(!defined("INC_NUMBER")) define("INC_NUMBER", 111000110043543513);
    if(!defined("NO_REPLY_EMAIL")) define("NO_REPLY_EMAIL", 'noreplay@host.tld');