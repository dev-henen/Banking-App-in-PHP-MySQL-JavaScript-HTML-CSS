<?php 
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        header('Location: /');
        exit;
    }

    $is_conn = $conn ?? null;
    if(is_null($is_conn)) {
        $connection->connect();
        $conn = $connection->get();
    }

    $login = $_SESSION['login'];
    $password = $_SESSION['password'];
    $account_type = $_SESSION['account_type'];

    $isIDWhat = null;
    if(filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $isIDWhat = "email";
    } elseif(!preg_match("/[^0-9\+]/", $login)) {
        $isIDWhat = "phone";
    } elseif(!preg_match("/[^a-zA-Z0-9]/", $login)) {
        $isIDWhat = "username";
    } else {
        http_response_code(400);
        exit;
    }

    $sql = "
        SELECT * 
        FROM `accounts` 
        WHERE `UserName` IS NOT NULL AND `UserName`=? 
        OR `Phone` IS NOT NULL AND `Phone`=? 
        OR `Email` IS NOT NULL AND `Email`=?
        LIMIT 1;
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $v1, $v1, $v1);
    $v1 = trim(stripslashes($login));
    $stmt->execute();
    $result = $stmt->get_result();
    if(!$result->num_rows > 0) {
        header('Location: /');
        exit;
    }
    $row = $result->fetch_assoc();
    $stmt->close();

    $pasword_hash = new Password_Hash($password);
    if($pasword_hash->verify($row['Password']) === true) {

        switch(strtolower($row["Status"])) {
            case 'locked':
                define('ACCOUNT', $row);
            break;
            case 'blocked':
                echo 'Account BLocked';
                http_response_code(403);
                exit;
            break;
            case 'pending':
                echo 'This account is not activated yet';
                http_response_code(102);
                exit;
            break;
            case 'active':

               define('ACCOUNT', $row);

            break;
            default:
                header('Location: /error');
        }

    } else {
        header('Location: /');
        exit;
    }

    //print_r(ACCOUNT);
?>