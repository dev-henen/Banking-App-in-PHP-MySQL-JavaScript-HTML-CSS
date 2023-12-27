<?php 
    session_start(); 
    require '../../config.php';
    require APP_BASE . 'account.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        http_response_code(401);
        exit;
    }
    if($_SESSION["account_type"] != "client") {
        http_response_code(403);
        exit;
    } 
?>

<div class="top" id="client-layout-top">
    <div class="wrap">
        <div class="left">
            <button onclick="onNavClick('/client/');"> <i class="bi bi-arrow-left" style="font-size: 1.5em;color:#555;"></i> </button>
        </div>
        <div class="right">
            <button onclick="logout();" style="color: #f00;"><small>Logout</small><i class="bi bi-door-open"></i></button>
        </div>
    </div>
</div>
<div class="midle">
    <div class="header">
        <h1 class="title">Edit/View Account Details</h1>
        <br/>
        <div class="intro">
            <div class="left">
                <p> <i> Note: Some fields may not be editable </i> </p>
            </div>
        </div>
    </div>
   <div class="main">

<?php 
    $connection->connect();
    $conn = $connection->get();
    $customer_id = ACCOUNT['ID'];
    settype($customer_id, 'integer');
    $sql = sprintf('SELECT * FROM accounts WHERE ID=%d LIMIT 1;', $customer_id);
    $result = $conn->query($sql);
    if($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $is_account_locked = ($row['Status'] == 'locked')? 'disabled' : '';

        ?>
        
        <div class="customer-profile">
            <p><b class="label">Account Status: </b> <?php echo $row['Status']; ?></p>
            <input type="hidden" id="update-customer-id" value="<?php echo htmlentities($row['ID']); ?>" <?php echo $is_account_locked; ?>/>

            <form onsubmit="return false;" method="post" action="" class="layout-form-2 for-client">

                <div class="wrap-2-input">
                    <span>
                        <label for="firstname">First Name:</label>
                        <input id="update-customer-firstname" type="text" value="<?php echo htmlentities($row['FirstName']); ?>" name="firstname" <?php echo $is_account_locked; ?>/>
                    </span>
                    
                    <span>
                        <label for="lastname">Last Name:</label>
                        <input id="update-customer-lastname" type="text" value="<?php echo htmlentities($row['LastName']); ?>" name="lastname" <?php echo $is_account_locked; ?>/>
                    </span>
                </div>

                <div>
                    <br/>
                    <b class="label">Gender:</b> <span> 
                        <?php echo strtoupper(substr($row['Gender'], 0, 1)) . strtolower(substr($row['Gender'], 1)); ?> 
                    </span>
                </div>

                <div>
                    <br/>
                    <b class="label">Account No:</b> <span> 
                        <?php echo $row['AccountNumber']; ?> 
                    </span>
                </div>

                <div>
                    <br/>
                    <label for="birthday">Birthday: </label>
                    <input id="update-customer-birthday" type="text" value="<?php echo htmlentities($row['Birthday']); ?>" name="birthday" <?php echo $is_account_locked; ?>/>
                </div>

                <div>
                    <br/>
                    <label for="pin">PIN (4 digit): </label>
                    <input id="update-customer-pin" type="text" value="<?php echo htmlentities($row['PIN']); ?>" name="pin" <?php echo $is_account_locked; ?>/>
                </div>

                <div class="wrap-2-input">
                    <br/>
                    <span>
                        <label for="email">Email:</label>
                        <input id="update-customer-email" type="email" value="<?php echo htmlentities($row['Email']); ?>" name="email" <?php echo $is_account_locked; ?>/>
                    </span>
                    
                    <span>
                        <label for="phone">Phone</label>
                        <input id="update-customer-phone" type="tel" value="<?php echo htmlentities($row['Phone']); ?>" name="phone" <?php echo $is_account_locked; ?>/>
                    </span>
                </div>

                <div>
                    <br/>
                    <label for="address">Address:</label>
                    <textarea id="update-customer-address" name="address" <?php echo $is_account_locked; ?>><?php echo htmlentities($row['Address']); ?></textarea>
                </div>

                <div class="wrap-2-input">
                    <br/>
                    <span>
                        <label for="username">Username:</label>
                        <input id="update-customer-username" type="text" value="<?php echo htmlentities($row['UserName']); ?>" name="username" <?php echo $is_account_locked; ?>/>
                    </span>
                    
                    <span>
                        <label for="password">Password:</label>
                        <input id="update-customer-password" type="password" value="" name="password" <?php echo $is_account_locked; ?>/>
                    </span>
                </div>

                <br/>
                <br/>
                <input onclick="validate_update_customer(this)"; type="submit" name="update" value="Save Changes" class="button" <?php echo $is_account_locked; ?>/>

            </form>

        </div>
        
        <?php

    } else {
        echo '<p style="font-size:3em;text-align:center;color:#f88;">Error</p>';
    }
?>
   </div>

</div>