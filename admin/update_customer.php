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
        $input = preg_replace('/\s+/', ' ', $input);
        $input = trim($input);
        return $input;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if(isset($_POST['firstname'])) {

            $id = $_POST['id'];
            settype($id, 'integer');



            if(empty($_POST['firstname'])) {
                echo 'Firstname is required';
                http_response_code(400);
                exit;
            } elseif(empty($_POST['lastname'])) {
                echo 'Lastname is required';
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
            } elseif(empty($_POST['address'])){
                echo 'Address is required';
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
                $sql = sprintf('SELECT ID FROM accounts WHERE Email="%s" AND NOT ID=%d;', stripslashes($_POST['email']), $id);
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    echo 'This email adddress has already been used by other customer';
                    http_response_code(400);
                    exit;
                }
            }

            if(!empty($_POST['phone'])) {
                $sql = sprintf('SELECT ID FROM accounts WHERE Phone=%d AND NOT ID=%d;', ((int) stripslashes($_POST['phone'])), $id);
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    echo 'This phone number has already been used by other customer';
                    http_response_code(400);
                    exit;
                }
            }

            if(!empty($_POST['username'])) {
                $sql = sprintf('SELECT ID FROM accounts WHERE UserName="%s" AND NOT ID=%d;', strtolower(stripslashes($_POST['username'])), $id);
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

            $hash_password = new Password_Hash($_POST['password']);
            
            $sql = "
                UPDATE 
                accounts SET
                    UserName=?, 
                    FirstName=?, 
                    LastName=?,
                    Phone=?, 
                    Birthday=?, 
                    Address=?, 
                    Email=?, 
                    Password=?, 
                    PIN=?
                WHERE ID=?;
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssssii', $v1, $v2, $v3, $v4, $v5, $v6, $v7, $v8, $v9, $v10);
            $v1 = strtolower(test_input($_POST['username']));
            $v2 = test_input($_POST['firstname']);
            $v3 = test_input($_POST['lastname']);
            $v4 = test_input($_POST['phone']);
            $v5 = test_input($_POST['birthday']);
            $v6 = test_input($_POST['address']);
            $v7 = test_input($_POST['email']);
            $v8 = $hash_password->do();
            $v9 = test_input($_POST['pin']);
            $v10 = (int) $id;
            if(!$stmt->execute()) {
                echo $stmt->error;
                @$stmt->close();
                echo 'Oops! Something went wrong, please try again';
                http_response_code(500);
                exit;
            }
            @$stmt->close();
        }

    }