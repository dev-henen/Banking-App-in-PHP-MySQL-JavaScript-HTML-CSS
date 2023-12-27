<?php 
    session_start(); 
    require '../config.php';
    require APP_BASE . 'account.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        http_response_code(401);
        exit;
    }
    if($_SESSION["account_type"] != "client") {
        http_response_code(403);
        exit;
    } 

    if(isset($_GET['q'])) {
        $history_result = array();
        $notification_result = array();

        $q = $_GET['q'];
        $q = preg_replace('/[^a-zA-Z0-9]/', '', $q);
        $q = (strlen($q) <= 30)? $q : substr($q, 0, 30);
        $total_result = array();

        $sql = sprintf('SELECT `Body`, `RecieveDate` FROM `bank_history` WHERE MATCH(`Body`) AGAINST("%s") AND `CustomerID`=%d ORDER BY `ID` DESC LIMIT 50', $q, ACCOUNT['ID']);
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            
            $history_result = $result->fetch_all(MYSQLI_ASSOC);

        }

        $sql = sprintf('SELECT `Body`, `RecieveDate` FROM `bank_notifications` WHERE MATCH(`Body`) AGAINST("%s") AND (`CustomerID`=%d OR `CustomerID`=0) ORDER BY `ID` DESC LIMIT 50', $q, ACCOUNT['ID']);
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            
            $notification_result = $result->fetch_all(MYSQLI_ASSOC);

        }

        $total_result = array(
            'history' => $history_result,
            'notifications' => $notification_result
        );
        echo json_encode($total_result);

    }