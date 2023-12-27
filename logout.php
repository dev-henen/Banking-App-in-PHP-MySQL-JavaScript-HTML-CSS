<?php 
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['password']);
    unset($_SESSION['account_type']);
    session_destroy();
    header('Location: /');
?>