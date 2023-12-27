<?php session_start();

    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        header('Location: /');
        exit;
    }

    switch(strtolower(stripslashes($_SESSION["account_type"]))) {
        case 'client':
            header('Location: client/');
        break;
        case 'agent':
            header('Location: agent/');
        break;
        case 'admin':
            header('Location: admin/');
        break;
        default:
            header('Location: error?ert=l&nc=' . rand(10000, 999999));
    }