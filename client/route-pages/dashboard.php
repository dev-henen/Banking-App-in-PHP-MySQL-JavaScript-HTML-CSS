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
        <h1 class="title">Hi <?php echo ACCOUNT['FirstName']; ?>,</h1>
        <div class="intro">
            <div class="left">
                <p>What do you want to do today?</p>
            </div>
            <div class="right">
                <span class="material-icon tooltip">
                    <span class="tooltip-content">View Insights</span>
                    <i class="bi bi-graph-up" onclick="onNavClick('/client/history');"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="top">
            <div class="left">
                <span class="balance"> $<?php echo number_format(ACCOUNT['CheckingBalance'], 2); ?> </span>
                <br />
                <span class="label"> Checking Account Balance </span>
            </div>
            <div class="right">
                <span class="balance"> $<?php echo number_format(ACCOUNT['Balance'], 2); ?> </span>
                <br />
                <span class="label"> Savings Account Balance </span>
            </div>
        </div>

        <div class="nav">

            <a href="javascript:void(0)" onclick="onNavClick('/client/transfer');">
                <div class="top">
                    <span class="ic"> <i class="bi bi-arrow-left-right"></i> </span>
                </div>
                <div class="bottom">
                    <h2>Transfer</h2>
                    <span class="label">Send & Request Funds</span>
                </div>
            </a>
            <a href="javascript:void(0)" class="green" onclick="onNavClick('/client/notifications');">
                <div class="top">
                    <span class="ic"> <i class="bi bi-bank"></i> </span>
                </div>
                <div class="bottom">
                    <h2>Statement</h2>
                    <span class="label">May be in notifications</span>
                </div>
            </a>
            <a href="javascript:void(0)" class="red" onclick="error('Sorry! Bill pay is not available.');">
                <div class="top">
                    <span class="ic"> <i class="bi bi-receipt"></i> </span>
                </div>
                <div class="bottom">
                    <h2>Bill Pay</h2>
                    <span class="label">Due on May 14th</span>
                </div>
            </a>
            <a href="javascript:void(0)" class="purple" onclick="alert('If you have rewards, please contact customer support to redeem.');">
                <div class="top">
                    <span class="ic"> <i class="bi bi-gift"></i> </span>
                </div>
                <div class="bottom">
                    <h2>Rewards</h2>
                    <span class="label"><?php echo number_format(ACCOUNT['Rewards'], 3); ?>  Points</span>
                </div>
            </a>

        </div>
    </div>
</div>