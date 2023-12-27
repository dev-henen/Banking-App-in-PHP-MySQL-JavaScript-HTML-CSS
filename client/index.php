<?php 
    session_start(); 
    require '../config.php';
    require APP_BASE . 'account.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        header('Location: /');
        exit;
    }
    if($_SESSION["account_type"] != "client") {
        header('Location: /error?ert=un&nc=' . rand(10000, 90000));
        exit;
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php Inc::use('head'); ?>
    <title><?php echo ACCOUNT['FirstName'] . ' ' . ACCOUNT['LastName']; ?> - Dashboard</title>
</head>
<body style="overflow-x: hidden;">

    <div class="client-layout">

        <div id="root"></div>
        <div class="bottom shadow" id="client-layout-bottom">
                <ul class="wrap">
                    <li> 
                        <a onclick="onNavClick('/client/');" id="dashboard-link" href="javascript:void(0)" class="active"> 
                            <i class="bi bi-grid"></i> 
                            <br/>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li> 
                        <a onclick="onNavClick('/client/transfer');" id="dashboard-sr-link" href="javascript:void(0)"> 
                            <i class="bi bi-currency-exchange"></i> 
                            <br/>
                            <span>Send & Request</span>
                        </a> 
                    </li>
                    <li> 
                        <a onclick="onNavClick('/client/history');" id="dashboard-h-link" href="javascript:void(0)"> 
                            <i class="bi bi-check-circle"></i> 
                            <br/>
                            <span>History</span>
                        </a> 
                    </li>
                    <li> 
                        <a onclick="onNavClick('/client/settings');" id="dashboard-s-link" href="javascript:void(0)"> 
                            <i class="bi bi-person-circle"></i> 
                            <br/>
                            <span>Settings</span>
                        </a> 
                    </li>
                </ul>
        </div>
    </div>
    
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


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

    <script type="text/javascript" src="<?php HOST_ROOT(); ?>assets/js/main.js"></script>
    <script type="text/javascript" src="<?php HOST_ROOT(); ?>assets/js/client_scroll_shadow.js"></script>
    <script type="text/javascript" src="./route.js"></script> 
    <script type="text/javascript" src="./update_customer.js"></script> 
    <script type="text/javascript" src="./transfer.js"></script> 
    <script type="text/javascript" src="./search.js"></script> 
</body>
</html>