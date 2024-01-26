<?php
    
    require_once 'initialize.php';
    require_once APP_BASE . 'classes/Database.php';
    require_once APP_BASE . 'classes/Include.php';
    require_once APP_BASE . 'classes/Password_Hasher.php';

    $connection = new mysql\Database(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);



    //Check if any account have login
    $bank_login_link = '<a href="javascript:void(0)" onclick="bankLogin();"><i class="bi bi-person"></i> LOGIN</a>';
    if(@count($_SESSION) > 0) {
        if(isset($_SESSION["account_type"]) && isset($_SESSION["login"]) && isset($_SESSION["password"])) {
            $bank_login_link = '<a href="/who_is.php"><i class="bi bi-person"></i> LOGIN</a>';
        }
    }
