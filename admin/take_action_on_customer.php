<?php 
    session_start(); 
    require '../config.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        http_response_code(401);
        exit;
    }
    if($_SESSION["account_type"] != "admin") {
        http_response_code(403);
        exit;
    } 
    $connection->connect();
    $conn = $connection->get();
?>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['action_type'])) {
            $action = stripslashes($_POST['action_type']);
            $action = strtolower($action);
            $customer = $_POST['customer'];
            if(preg_match('/[^a-z]/', $action) && preg_match('/[^0-9]/', $customer)) {

                http_response_code(400);

            } else {
                
                if(in_array($action, ['lock', 'block', 'delete', 'activate', 'pend'])) {

                    switch($action) {
                        case 'lock':
                            $action = 'locked';
                        break;
                        case 'block':
                            $action = 'blocked';
                        break;
                        case 'delete':
                            $action = 'delete';
                        break;
                        case 'activate':
                            $action = 'active';
                        break;
                        case 'pend':
                            $action = 'pending';
                        break;
                        default:
                            $action = 'pending';
                    }

                    if($action == 'delete') {
                        $sql = sprintf('DELETE FROM accounts WHERE ID=%d', ((int) $customer));
                    } else {
                        $sql = sprintf('UPDATE accounts SET Status="%s" WHERE iD=%d LIMIT 1;', $action, ((int) $customer));
                    }
                    if($conn->query($sql)) {
                        http_response_code(200);
                    } else {
                        http_response_code(500);
                    }

                } else {
                    http_response_code(400);
                }

            }
        }

    }