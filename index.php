<?php session_start(); require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <?php Inc::use('head'); ?>
    <title>Bank | Home</title>
</head>

<body>

    <div class="layout">

        <header>

            <div class="navigation">
                <?php Inc::use('top', $bank_login_link); ?>
            </div>
            <div class="hero">
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <div class="hero-text">
                    <p>Your Bank <br />at Your <br />Fingertips</p>
                </div>
            </div>

        </header>

    </div>

    <div class="layout-overlay" style="display: none;" id="bank-login">
        <div class="wrap-like-midle">
            <div class="content">
                <div>
                    <h2><?php echo APP_NAME ?> Login</h2>
                    <p>Easily manage your bank history!</p>
                </div>
                <div>
                    <form method="post" action="" class="client-form" onsubmit="return false;">
                        <label>Username/Phone/Email</label>
                        <input id="bankLoginUsername" type="text" name="username" placeholder="user | +01****32 | ex**@email.tld" />
                        <label>Password</label>
                        <input id="bankLoginPassword" type="password" name="password" placeholder="Password" />
                        <a href="javascript:void(0)" onclick="forgotPassword();">Forgot password?</a>
                        <br /><br />

                        <?php 
                            if(DEVICE == 'mobile') {
                                ?>
                                <input class="button" onclick="Login();" type="submit" name="login" value="Login" /><br/>
                                <button class="button" onclick="bankLogin();" style="background-color:#111;">Cancel</button>
                                <?php
                            } else {
                                ?>
                                <button class="button" onclick="bankLogin();" style="background-color:#111;">Cancel</button>
                                <input class="button" onclick="Login();" type="submit" name="login" value="Login" />
                                <?php
                            }
                        ?>
                        <br />
                        <br />
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="layout-overlay" style="display: none;" id="bank-login-forgot-password">
        <div class="wrap-like-midle">
            <div class="content">
                <div>
                    <h2>Forgot Your Login Password?</h2>
                    <p>Don't worry you can get a new one!</p>
                </div>
                <div>
                    <form method="post" action="" class="client-form" onsubmit="return false;">
                        <label class="wrap-icon-input">Phone/Email</label>
                        <input id="forgot-password-user" type="text" name="forgotPasswordUser" placeholder="+01****32 | ex**@email.tld" />
                        <label class="wrap-icon-input">New Password</label>
                        <input id="forgot-password-new-password" type="text" name="forgotPasswordNewP" placeholder="******" />
                        <label id="forgot-password-otp-label" style="color:#f33;"></label>
                        <label id="forgot-password-next-request-time" style="color:#f33;"></label>
                        <label id="forgot-password-next-atempts" style="color:#f33;"></label>
                        <input id="forgot-password-otp" type="text" name="forgotPasswordOTP" placeholder="OTP" style="text-align: center;display:none;"/>
                        <br /><br />

                        <?php 
                            if(DEVICE == 'mobile') {
                                ?>
                                <input class="button" onclick="getLoginOTP(this);" type="submit" name="getNewPassword" value="Get OTP" /><br/>
                                <button class="button" onclick="forgotPassword();" style="background-color:#111;">Cancel</button>
                                <?php
                            } else {
                                ?>
                                <button class="button" onclick="forgotPassword();" style="background-color:#111;">Cancel</button>
                                <input class="button" onclick="getLoginOTP(this);" type="submit" name="getNewPassword" value="Get OTP" />
                                <?php
                            }
                        ?>
                        <br />
                        <br />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="layout-error" class="layout-error" style="display: none;">
        <div class="symbol">
            <span class="cancel" onclick="error();"> &times; </span>
            <img src="<?php HOST_ROOT(); ?>assets/images/error.png" alt="Error Image" width="60" />
        </div>
        <div class="message">
            <p id="layout-error-message"></p>
        </div>
    </div>

    <div id="layout-ajax-clock" class="layout-ajax-clock" style="display: none;">
        <div>
            <img src="<?php HOST_ROOT(); ?>assets/images/ajax_clock.gif" alt="Clock" width="20"/>
        </div>
    </div>

    <?php Inc::use('footer'); ?>
    <script type="text/javascript" src="<?php HOST_ROOT(); ?>assets/js/main.js"></script>
    <script type="text/javascript" src="<?php HOST_ROOT(); ?>login_client.js"></script>
</body>

</html>