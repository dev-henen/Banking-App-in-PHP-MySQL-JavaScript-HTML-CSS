<?php session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require 'config.php';
        $connection->connect();
        $conn = $connection->get();

        if(isset($_POST["username"]) && isset($_POST["password"])) {

            if(empty($_POST["username"]) || empty($_POST["password"])) {
                http_response_code(500);
            } else {
                $isIDWhat = null;
                if(filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
                    $isIDWhat = "email";
                } elseif(!preg_match("/[^0-9\+]/", $_POST["username"])) {
                    $isIDWhat = "phone";
                } elseif(!preg_match("/[^a-zA-Z0-9]/", $_POST["username"])) {
                    $isIDWhat = "username";
                } else {
                    http_response_code(400);
                    exit;
                }

                $sql = "
                    SELECT `Type`, `Status`, `Password` 
                    FROM `accounts` 
                    WHERE `UserName` IS NOT NULL AND `UserName`=? 
                    OR `Phone` IS NOT NULL AND `Phone`=? 
                    OR `Email` IS NOT NULL AND `Email`=?
                    LIMIT 1;
                ";
                $stmt = $conn->prepare($sql);
                echo $stmt->error;
                $stmt->bind_param('sss', $v1, $v1, $v1);
                $v1 = trim(stripslashes($_POST['username']));
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result->num_rows > 0) {
                    http_response_code(400);
                    exit;
                }
                $row = $result->fetch_assoc();
                $stmt->close();

                $pasword_hash = new Password_Hash($_POST['password']);
                if($pasword_hash->verify($row['Password']) === true) {

                    switch(strtolower($row["Status"])) {
                        case 'locked':
                            //http_response_code(423);
                            $_SESSION["account_type"] = $row["Type"];
                            $_SESSION["login"] = $_POST["username"];
                            $_SESSION["password"] = $_POST["password"];
                            http_response_code(200);
                        break;
                        case 'blocked':
                            http_response_code(403);
                        break;
                        case 'pending':
                            http_response_code(102);
                        break;
                        case 'active':

                           $_SESSION["account_type"] = $row["Type"];
                           $_SESSION["login"] = $_POST["username"];
                           $_SESSION["password"] = $_POST["password"];
                           http_response_code(200);

                        break;
                        default:
                            http_response_code(500);
                    }

                } else {
                    http_response_code(400);
                }

            }

        } else {
            http_response_code(500);
        }
    }
