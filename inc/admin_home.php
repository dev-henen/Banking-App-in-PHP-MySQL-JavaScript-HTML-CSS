<?php if (!isset($is_inc)) {
    http_response_code(403);
    exit;
} elseif ($is_inc !== INC_NUMBER) {
    http_response_code(403);
    exit;
}; 
require '../config.php';
require APP_BASE . 'account.php';
?>
<div class="admin-dashboard">
    <h1>Administrator</h1>
    <p class="amount"><b>Bank Balance:</b> <br/>$<?php echo number_format(ACCOUNT['Balance'], 2); ?></>
</div>