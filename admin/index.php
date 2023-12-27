<?php 
    session_start(); 
    require '../config.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        header('Location: /');
        exit;
    }
    if($_SESSION["account_type"] != "admin") {
        header('Location: /error?ert=un&nc=' . rand(10000, 90000));
        exit;
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php Inc::use('head'); ?>
    <title>Admin - Dashboard</title>
</head>
<body style="overflow-x: hidden;">
    <?php Inc::use('top_admin'); ?>

    <div class="layout-dashboard">
        <div class="left" id="dashboard">
            <ul>
                <li> <a href="<?php HOST_ROOT(); ?>"> <i class="bi bi-house"></i> HOME </a> </li>
                <li> <a href="./"> <i class="bi bi-bank"></i> DASHBOARD </a> </li>
                <li> 
                    <!--------------------------=================----------------------------->
                    <a onclick="showLeftNestedLinks(this);" href="javascript:void(0)"> 
                        <i class="bi bi-people"></i> CUSTOMERS 
                        <span class="bi bi-chevron-down" name="indicator"></span> 
                    </a>
                    <!------------------------------------------------------------------------>
                    <div class="content">
                        <ul>
                            <li> <a href="./?p=1.0"> Add customer </a> </li>
                            <li> <a href="./?p=1.1"> Manage customers </a> </li>
                        </ul>
                    </div>
                    <!--------------------------=================---------------------------->
                </li>
                <li> 
                    <!----------------------------------------------------------------------->
                    <a onclick="showLeftNestedLinks(this);" href="javascript:void(0)">
                        <i class="bi bi-bank2"></i> BANK MANAGEMENT 
                        <span class="bi bi-chevron-down" name="indicator"></span> 
                    </a> 
                    <!----------------------------------------------------------------------->
                    <div class="content">
                        <ul>
                            <li> <a href="./?p=1.3"> Add fund </a> </li>
                        </ul>
                    </div>
                    <!----------------------------------------------------------------------->
                </li>
                <li> <a href="javascript:void(0)" onclick="logout();"> <i class="bi bi-door-open"></i> LOGOUT </a> </li>
            </ul>
        </div>
        <div class="right">

        <?php 
            switch(stripslashes(@$_GET["p"])) {
                case '1.0':
                    Inc::use('add_customer');
                break;
                case '1.1':
                    Inc::use('manage_customers', null, null, $connection);
                break;
                case '1.2':
                    Inc::use('edit_customer', null, array(
                        'customer_id' => $_GET['edt-c-a']
                    ), $connection);
                break;
                case '1.3':
                    Inc::use('add_fund');
                break;
                default:
                    Inc::use('admin_home');
            }
        ?>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
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

    <script type="text/javascript" src="<?php HOST_ROOT(); ?>assets/js/main.js"></script> 
    <script type="text/javascript" src="./add_customer.js"></script> 
    <script type="text/javascript" src="./update_customer.js"></script> 
    <script type="text/javascript" src="./take_action_on_customer.js"></script> 
    <script type="text/javascript" src="./add_fund.js"></script> 
</body>
</html>