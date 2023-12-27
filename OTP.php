<?php session_start(); require 'config.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if(isset($_POST['user'])) {

            $connection->connect();
            $conn = $connection->get();

            if(
                !filter_var($_POST['user'], FILTER_VALIDATE_EMAIL) &&
                preg_match('/[^0-9\+]/', $_POST['user'])
            ) {
                http_response_code(400);
                echo 'Please enter you email or phone number';
                exit;
            }

            $user = $_POST['user'];

            $sql = sprintf('SELECT `Email` FROM `accounts` WHERE `Email`="%s" OR `Phone`="%s" LIMIT 1;', $user, $user);
            $result = $conn->query($sql);
            if($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $otp = rand(100000, 999999);
                $_SESSION['forgot_password_otp'] = $otp;
                $_SESSION['forgot_password_user'] = $user;
                $_SESSION['forgot_password_user_email'] = $row['Email'];
                $_SESSION['number_of_atempts'] = 5;

                $message = "
                    <html>
                        <head>
                            <title>".APP_NAME." OTP</title>
                        </head>
                        <body>
                            <div>
                            <h1>Here is your ".APP_NAME." One Time Password (OTP)</h1>
                            <h2>Verify code to reset your password</h2>
                            <p>No OTP will expire in 30 menutes</p>
                            <p><strong>OTP:</strong> ".$otp."</p>
                            <br/>
                            <br/>
                            <p>
                                <strong>Note:</strong>
                                Do not share this code with anyone.
                            </p>
                            <h3>Thank you!</h3>
                            <h4><a href='".GET_HOST_ROOT()."' title='".GET_HOST_ROOT()."'>".HOST_NAME."</a></h4>
                            <br/>
                            <br/>
                            </div>
                        </body>
                    </html>
                ";
                $subject = APP_NAME . ' OTP';
                $headers = 'Content-type: text/html;charset=UTF-8'."\r\n";
                $headers .= 'From: '.NO_REPLY_EMAIL."\r\n";
                $send = @mail($row['Email'], $subject, $message, $headers);
                if(!$send) {
                    http_response_code(500);
                    echo 'Oops! Something went wrong sending OTP, please try again';
                    exit;
                }

            } else {
                http_response_code(400);
                echo 'No result was found for the information you provided';
                exit;
            }

            http_response_code(200);
            echo 'If this email or phone number is associated 
                with any account, please check your email inbox we\'ve sent you OTP.'.$otp;

        }

    }