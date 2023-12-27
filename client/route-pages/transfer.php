<?php 
    session_start(); 
    require '../../config.php';
    require APP_BASE . 'account.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        http_response_code(301);
        exit;
    }
    if($_SESSION["account_type"] != "client") {
        http_response_code(303);
        exit;
    } 
?>

<div class="top" id="client-layout-top">
    <div class="wrap">
        <div class="left">
            <span class="icon">
                <img src="<?php HOST_ROOT(); ?>assets/images/icon.png" width="50" alt="Icon" />
            </span>
        </div>
        <div class="right">
            <button onclick="onNavClick('/client/search');"> <i class="bi bi-search"></i> </button>
            <button onclick="onNavClick('/client/notifications');"> <i class="bi bi-bell"></i> </button>
        </div>
    </div>
</div>
<div class="midle">
    <div class="header">
        <h1 class="title">Tranfer Funds</h1>
        <div class="intro">
            <div class="left">
                <p>You can transfer or request funds from other accounts</p>
            </div>
        </div>
    </div>
    <div class="main">
      
    <form onsubmit="return false;" method="post" action="" class="client-form">

        <label for="add-funds-account-number">Account Number</label>
        <input id="add-fund-account-number" type="number" name="account_number" placeholder="14xxxxxx99" formnovalidate />
        <label for="add-fund-account-number">Amount</label>
        <input id="add-fund-amount" type="number" name="amount" placeholder="$100 (USD)" formnovalidate />
        <label for="add-fund-bank">Bank</label>
        <select id="add-fund-bank" name="bank">
            <option value=""></option>
            <option value="this"><?php echo APP_NAME; ?></option>
            <option value="other">Other Bank</option>
        </select>
        <br />
        <br />
        <input onclick="transfer_funds();" type="button" name="submit" value="Continue" class="button" />
       

        <div class="layout-overlay" style="display: none;" id="confirm-funding">
            <div class="wrap-like-midle">
                <div class="content">
                    <div>
                        <h2>Confirm transaction</h2>
                    </div>
                    <div>
                        <div id="add-fund-response"></div>
                        <label for="add-fund-pin">Please confirm 4 digit PIN!</label>
                        <input id="add-fund-pin" type="number" name="pin" placeholder="PIN (4 digit)" formnovalidate />
                        <br />
                        <br />
                        <input class="button inline" onclick="document.getElementById('confirm-funding').style.display = 'none';" type="button" name="cancel" value="Cancel" style="background-color:#222;" />
                        <input class="button inline" onclick="confirm_fund();" type="submit" name="submit" value="Confirm" />
                    </div>
                </div>
            </div>
        </div>


    </form>


    </div>
</div>