<?php 
    session_start(); 
    require '../config.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        http_response_code(401);
        exit;
    }
    if($_SESSION["account_type"] != "client") {
        http_response_code(403);
        exit;
    } 
    $connection->connect();
    $conn = $connection->get();

    require APP_BASE . 'account.php';
    include APP_BASE . 'classes/History.php';
?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        if(isset($_POST['confirm']) && isset($_POST['account'])) {

            $account = $_POST['account'];
            if(preg_match('/[^0-9]/', $account)) {
                http_response_code(500);
                exit;
            } elseif(strlen($account) != 10) {
                http_response_code(500);
                exit;
            }

            $sql = sprintf('SELECT `FirstName`, `LastName` FROM `accounts` WHERE `AccountNumber`=%d LIMIT 1;', $account);
            $result = $conn->query($sql);
            if($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                echo $row['FirstName'] . ' ' . $row['LastName'];
                exit;

            } else {
                http_response_code(400);
                exit;
            }

        }
        
        if(isset($_POST['add']) && isset($_POST['account']) && isset($_POST['amount']) & isset($_POST['pin']) && isset($_POST['bank'])) {

            $account = $_POST['account'];
            $amount = $_POST['amount'];
            $bank = $_POST['bank'];
            $pin = $_POST['pin'];
            if(preg_match('/[^0-9]/', $account)) {
                http_response_code(500);
                exit;
            } elseif(strlen($account) != 10) {
                http_response_code(500);
                exit;
            }
            if(preg_match('/[^0-9\.]/', $amount)) {
                http_response_code(500);
                exit;
            } elseif($account <= 0) {
                http_response_code(500);
                exit;
            }
            if(preg_match('/[^0-9]/', $pin)) {
                http_response_code(500);
                exit;
            } elseif(strlen($pin) != 4) {
                http_response_code(500);
                exit;
            }

            $debit_account = ACCOUNT['AccountNumber'];

            if(strtolower($bank) == 'other') {
                
                $debit_sql = sprintf('SELECT `Balance`, `PIN` FROM `accounts` WHERE `AccountNumber`=%d LIMIT 1;', $debit_account);
                $result = $conn->query($debit_sql);
                if($result->num_rows > 0) {
    
                    $row = $result->fetch_assoc();
                    if($row['PIN'] != $pin) {
                        echo 'Wrong PIN!';
                        http_response_code(400);
                        exit;
                    }
                    if(ACCOUNT['Status'] == 'locked') {
                        http_response_code(423);
                        exit;
                    }
                    
                    $amount_to_transfer = $amount;
                    $tranfer_source_balance = $row['Balance'];
                    
                    if($tranfer_source_balance > $amount_to_transfer) {
    
                        $tranfer_source_balance_remainder = $tranfer_source_balance - $amount_to_transfer;
    
                        $debit_sql = sprintf('UPDATE accounts SET Balance=%s WHERE AccountNumber=%d LIMIT 1;', $tranfer_source_balance_remainder, $debit_account);
                        $conn->query($debit_sql);
    
                        $history = new History($conn);
                        $history->set_customer_id(ACCOUNT['ID']);
                        $history->set_body('You tranfered '.$amount_to_transfer.' USD to '.$account.', on '.date('l, d M, Y').', at '.date('H:i'));
                        $history->save();
                        
                        http_response_code(200);
    
                    } else {
                        echo 'Insurficient Balance to process transaction';
                        http_response_code(400);
                        exit;
                    }
    
                } else {
                    http_response_code(500);
                }

            } else {

                $debit_sql = sprintf('SELECT `Balance`, `PIN` FROM `accounts` WHERE `AccountNumber`=%d LIMIT 1;', $debit_account);
                $add_sql = sprintf('SELECT `ID`, `Balance` FROM `accounts` WHERE `AccountNumber`=%d LIMIT 1;', $account);
                $result = $conn->query($debit_sql);
                $destination_result = $conn->query($add_sql);
                if($result->num_rows > 0 && $destination_result->num_rows > 0) {
    
                    $row = $result->fetch_assoc();
                    $destination_row = $destination_result->fetch_assoc();
                    if($row['PIN'] != $pin) {
                        echo 'Wrong PIN!';
                        http_response_code(400);
                        exit;
                    }
                    if(ACCOUNT['Status'] == 'locked') {
                        http_response_code(423);
                        exit;
                    }
                    
                    $amount_to_transfer = $amount;
                    $tranfer_source_balance = $row['Balance'];
                    $destination_balance = $destination_row['Balance'];
                    
                    if($tranfer_source_balance > $amount_to_transfer) {
    
                        $tranfer_source_balance_remainder = $tranfer_source_balance - $amount_to_transfer;
                        $tranfer_destination_total_balance = $destination_balance + $amount_to_transfer;
    
                        $debit_sql = sprintf('UPDATE accounts SET Balance=%s WHERE AccountNumber=%d LIMIT 1;', $tranfer_source_balance_remainder, $debit_account);
                        $add_sql = sprintf('UPDATE accounts SET Balance=%s WHERE AccountNumber=%d LIMIT 1;', $tranfer_destination_total_balance, $account);
                        $conn->query($debit_sql);
                        $conn->query($add_sql);
    
                        $history = new History($conn);
                        $history->set_customer_id(ACCOUNT['ID']);
                        $history->set_body('You tranfered '.$amount_to_transfer.' USD to '.$account.', on '.date('l, d M, Y').', at '.date('H:i').'. <br/><b>Bank:</b> '.htmlspecialchars(stripslashes($bank)));
                        $history->save();
    
                        $history->set_customer_id($destination_row['ID']);
                        $history->set_body('You revieve '.$amount_to_transfer.' USD from '.ACCOUNT['AccountNumber'].', on '.date('l, d M, Y').', at '.date('H:i').'. <br/><b>Bank:</b> '.APP_NAME);
                        $history->save();
                        
                        http_response_code(200);
    
                    } else {
                        echo 'Insurficient Balance to process transaction';
                        http_response_code(400);
                        exit;
                    }
    
                } else {
                    http_response_code(500);
                }
                
            }



        }

    }
