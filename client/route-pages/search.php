<?php 
    session_start(); 
    require '../../config.php';
    require APP_BASE . 'account.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        http_response_code(301);
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
            <button onclick="onNavClick('/client/');"> <i class="bi bi-arrow-left" style="font-size: 1.5em;color:#333;"></i> </button>
        </div>
        <div class="right">
            <b style="padding:10px;">Search</b>
        </div>
    </div>
</div>
<div class="midle">
    <div class="header">
        <form class="client-form" onsubmit="return false;" method="get" action="">
            <div class="wrap-button-with-input">
                <input id="client-search-input" type="text" name="search" placeholder="Search"/>
                <button onclick="client_search();" class="button inline transparent"> <i class="bi bi-search"></i> </button>
            </div>
        </form>
    </div>
    <div class="main"> <ul id="client-search-root"></ul></div>
</div>