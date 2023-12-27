<?php session_start(); require 'config.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if(
            isset($_POST['user']) && 
            isset($_POST['password']) && 
            isset($_POST['otp']) &&
            isset($_SESSION['forgot_password_otp']) &&
            isset($_SESSION['forgot_password_user']) &&
            isset($_SESSION['forgot_password_user_email'])
        ) {
            if($_SESSION['forgot_password_user'] != $_POST['user']) {
                http_response_code(500);
                exit;
            }
            if($_SESSION['forgot_password_otp'] != $_POST['otp']) {
                if(isset($_SESSION['number_of_atempts'])) {
                    $_SESSION['number_of_atempts'] = 4;
                } else {
                    $get_X = (int) $_SESSION['number_of_atempts'];
                    $_SESSION['number_of_atempts'] = $get_X - 1;
                }
                $get_y = (int) $_SESSION['number_of_atempts'];
                if($get_y <= 0) {

                    unset($_SESSION['forgot_password_otp']);
                    unset($_SESSION['forgot_password_user']);
                    unset($_SESSION['forgot_password_user_email']);

                }
                http_response_code(400);
                exit;
            }

            $connection->connect();
            $conn = $connection->get();

            if(strlen($_POST['password']) > 100 || strlen($_POST['password']) < 6) {
                http_response_code(500);
                exit;
            }

            $hash_password = new Password_Hash($_POST['password']);
            
            $sql = 'UPDATE `accounts` SET `Password`=? WHERE `Email`=? LIMIT 1';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $v1, $v2);
            $v1 = $hash_password->do();
            $v2 = $_SESSION['forgot_password_user_email'];
            if($stmt->execute()) {

                http_response_code(200);

                @$stmt->close();
            } else {
                @$stmt->close();
                http_response_code(500);
                exit;
            }
            

        } else {
            http_response_code(500);
        }
    }