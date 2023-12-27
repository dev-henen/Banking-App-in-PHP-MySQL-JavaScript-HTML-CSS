<?php if(!isset($is_inc)) { http_response_code(403); exit; } elseif($is_inc !== INC_NUMBER) { http_response_code(403); exit; }; ?>
<h1>Edit/View Customer Details...</h1>
<hr/>
<?php 
    $connection->connect();
    $conn = $connection->get();
    $customer_id = $params['customer_id'];
    settype($customer_id, 'integer');
    $sql = sprintf('SELECT * FROM accounts WHERE ID=%d LIMIT 1;', $customer_id);
    $result = $conn->query($sql);
    if($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        ?>
        
        <div class="customer-profile">
            <p><b>Customer ID: </b> <?php echo $row['ID']; ?></p>
            <p><b>Customer Status: </b> <?php echo $row['Status']; ?></p>
            <input type="hidden" id="update-customer-id" value="<?php echo htmlentities($row['ID']); ?>"/>

            <form onsubmit="return false;" method="post" action="" class="layout-form-2">

                <div class="wrap-2-input">
                    <span>
                        <label for="firstname">First Name:</label>
                        <input id="update-customer-firstname" type="text" value="<?php echo htmlentities($row['FirstName']); ?>" name="firstname"/>
                    </span>
                    
                    <span>
                        <label for="lastname">Last Name:</label>
                        <input id="update-customer-lastname" type="text" value="<?php echo htmlentities($row['LastName']); ?>" name="lastname"/>
                    </span>
                </div>

                <div>
                    <br/>
                    <b class="label">Balance (USD):</b> <span> <?php echo $row['Balance']; ?> </span>
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
                    <input id="update-customer-birthday" type="text" value="<?php echo htmlentities($row['Birthday']); ?>" name="birthday"/>
                </div>

                <div>
                    <br/>
                    <label for="pin">PIN (4 digit): </label>
                    <input id="update-customer-pin" type="text" value="<?php echo htmlentities($row['PIN']); ?>" name="pin"/>
                </div>

                <div class="wrap-2-input">
                    <br/>
                    <span>
                        <label for="email">Email:</label>
                        <input id="update-customer-email" type="email" value="<?php echo htmlentities($row['Email']); ?>" name="email"/>
                    </span>
                    
                    <span>
                        <label for="phone">Phone</label>
                        <input id="update-customer-phone" type="tel" value="<?php echo htmlentities($row['Phone']); ?>" name="phone"/>
                    </span>
                </div>

                <div>
                    <br/>
                    <label for="address">Address:</label>
                    <textarea id="update-customer-address" name="address"><?php echo htmlentities($row['Address']); ?></textarea>
                </div>

                <div class="wrap-2-input">
                    <br/>
                    <span>
                        <label for="username">Username:</label>
                        <input id="update-customer-username" type="text" value="<?php echo htmlentities($row['UserName']); ?>" name="username"/>
                    </span>
                    
                    <span>
                        <label for="password">Password:</label>
                        <input id="update-customer-password" type="password" value="" name="password"/>
                    </span>
                </div>

                <div class="scroll-x" style="white-space:nowrap;">
                    <?php 
                        if($row['Status'] == 'active') {
                            ?>
                                <button onclick="takeActionOnCusromer('lock', <?php echo $row['ID']; ?>)" class="button inline" style="background-color:#444;">Lock Account</button>
                                <button onclick="takeActionOnCusromer('block', <?php echo $row['ID']; ?>)" class="button inline" style="background-color:#222;">Block Account</button>
                            <?php
                        } else {
                            ?>
                                <button onclick="takeActionOnCusromer('activate', <?php echo $row['ID']; ?>)" class="button inline" style="background-color:#595;">Activate Account</button>
                            <?php
                        }
                    ?>
                    <button onclick="takeActionOnCusromer('delete', <?php echo $row['ID']; ?>)" class="button inline" style="background-color:#f55;">Delete Account</button>
                </div>

                <hr/>
                <br/>
                <input onclick="validate_update_customer(this)"; type="submit" name="update" value="Update" class="button"/>
                <?php if(DEVICE == 'mobile') echo '<br/>'; ?>
                <input type="reset" class="button" value="Cancel" style="background-color:#222;"/>
                

            </form>

        </div>
        
        <?php

    } else {
        echo '<p style="font-size:3em;text-align:center;color:#f88;">Customer Not Found</p>';
    }
?>