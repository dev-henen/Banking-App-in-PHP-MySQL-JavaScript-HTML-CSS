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
    function test_input($input) {
        $input = stripslashes($input);
        $input = trim($input);
        return $input;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if(isset($_POST['firstname'])) {

            if(empty($_POST['firstname'])) {
                echo 'Firstname is required';
                http_response_code(400);
                exit;
            } elseif(empty($_POST['lastname'])) {
                echo 'Lastname is required';
                http_response_code(400);
                exit;
            } elseif(empty($_POST['gender'])) {
                echo 'Gender is required';
                http_response_code(400);
                exit;
            } elseif(empty($_POST['birthday'])) {
                echo 'Birthday is required';
                http_response_code(400);
                exit;
            } elseif(empty($_POST['email']) && empty($_POST['phone']) || empty($_POST['phone']) && empty($_POST['email'])) {
                echo 'You must provide either email or phone number';
                http_response_code(400);
                exit;
            } elseif(empty($_POST['pin'])) {
                echo 'PIN is required';
                http_response_code(400);
                exit;
            } elseif(empty($_POST['username'])) {
                echo 'Username is required';
                http_response_code(400);
                exit;
            } elseif(empty($_POST['password'])) {
                echo 'Password is required';
                http_response_code(400);
                exit;
            }

            if(preg_match('/[^a-zA-Z]/', $_POST['firstname'])) {
                echo 'Firstname is not valid';
                http_response_code(400);
                exit;
            }
            if(preg_match('/[^a-zA-Z]/', $_POST['lastname'])) {
                echo 'Lastname is not valid';
                http_response_code(400);
                exit;
            }

            if(!in_array(strtolower($_POST['gender']), ['female', 'male', 'other'])) {
                echo 'Gender is not valid';
                http_response_code(400);
                exit;
            }

            if(count(explode('/', $_POST['birthday'])) != 3 && count(explode('-', $_POST['birthday'])) != 3) {
                echo 'Birthday is not valid';
                http_response_code(400);
                exit;
            }

            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo 'Invalid email address';
                http_response_code(400);
                exit;
            }
            if(preg_match('/[^0-9\+]/', $_POST['phone'])) {
                echo 'Invalid phone number';
                http_response_code(400);
                exit;
            }

            if(preg_match('/[^0-9\.]/', $_POST['balance'])) {
                echo 'Invalid opennig palance';
                http_response_code(400);
                exit;
            }

            if(preg_match('/[^0-9]/', $_POST['pin']) || strlen($_POST['pin']) != 4) {
                echo 'Invalid PIN';
                http_response_code(400);
                exit;
            }

            if(preg_match('/[^0-9A-Za-z]/', $_POST['username'])) {
                echo 'Username is not valid';
                http_response_code(400);
                exit;
            }

            if(!empty($_POST['email'])) {
                $sql = sprintf('SELECT ID FROM accounts WHERE Email="%s";', stripslashes($_POST['email']));
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    echo 'This email adddress has already been used by other customer';
                    http_response_code(400);
                    exit;
                }
            }

            if(!empty($_POST['phone'])) {
                $sql = sprintf('SELECT ID FROM accounts WHERE Phone=%d;', ((int) stripslashes($_POST['phone'])));
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    echo 'This phone number has already been used by other customer';
                    http_response_code(400);
                    exit;
                }
            }

            if(!empty($_POST['username'])) {
                $sql = sprintf('SELECT ID FROM accounts WHERE UserName="%s";', strtolower(stripslashes($_POST['username'])));
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    echo 'This username is not available';
                    http_response_code(400);
                    exit;
                } elseif(preg_match('/admin/', strtolower($_POST['username']))) {
                    echo 'This username is not available';
                    http_response_code(400);
                    exit;
                }
            }
            
            function generate_account_number($conn) {
                $account_number = ((int) time());
                if(strlen(''. $account_number .'') != 10) {
                    $account_number = (int)(substr('' . ($account_number * $account_number) .'', 0, 10));
                }
                $sql = 'SELECT ID FROM accounts WHERE AccountNumber='.$account_number.';';
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    generate_account_number($conn);
                } else {
                    return $account_number;
                }
            }

            $account_number = generate_account_number($conn);
            $hash_password = new Password_Hash($_POST['password']);
            
            $sql = "
                INSERT INTO 
                accounts(
                    UserName, 
                    FirstName, 
                    LastName,
                    Gender, 
                    AccountNumber, 
                    Phone, 
                    Email, 
                    Password, 
                    PIN, 
                    Status
                ) VALUES(?,?,?,?,?,?,?,?,?,?);
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssisssis', $v1, $v2, $v3, $v4, $v5, $v6, $v7, $v8, $v9, $v10);
            $v1 = strtolower(test_input($_POST['username']));
            $v2 = test_input($_POST['firstname']);
            $v3 = test_input($_POST['lastname']);
            $v4 = test_input($_POST['gender']);
            $v5 = $account_number;
            $v6 = test_input($_POST['phone']);
            $v7 = test_input($_POST['email']);
            $v8 = $hash_password->do();
            $v9 = test_input($_POST['pin']);
            $v10 = 'active';
            if(!$stmt->execute()) {
                @$stmt->close();
                echo 'Oops! Something went wrong, please try again';
                http_response_code(500);
                exit;
            }
            @$stmt->close();
        }

    }