<?php if(!isset($is_inc)) { http_response_code(403); exit; } elseif($is_inc !== INC_NUMBER) { http_response_code(403); exit; }; ?>
<h1>Add Money to Customer's Account</h1>
<hr/>

<div class="add_fund">
    <form onsubmit="return false;" method="post" action="" class="layout-form">

    <div class="wrap-icon-input on-mobile-size">
        <span class="icon">
            <i class="bi bi-person"></i>
        </span>
        <input id="add-fund-account-number" type="number" name="account_number" placeholder="Account Number" formnovalidate/>
    </div>
    <div class="wrap-icon-input on-mobile-size">
        <span class="icon">
            <i class="bi bi-currency-dollar"></i>
        </span>
        <input id="add-fund-amount" type="number" name="amount" placeholder="Amount (USD)" formnovalidate/>
    </div>
    <br/>
    <br/>
    <input onclick="add_fund();" type="button" name="submit" value="Continue" class="button"/>
    
    <div class="layout-overlay" style="display: none;" id="confirm-funding">
        <div class="wrap-like-midle">
            <div class="content">
                <div>
                    <h2>Confirm transaction</h2>
                </div>
                <div>
                    <div id="add-fund-response"></div>
                    <p><strong>Please confirm 4 digit PIN!</strong></p>
                    <div class="wrap-icon-input on-mobile-size">
                        <span class="icon">
                            <i class="bi bi-key"></i>
                        </span>
                        <input id="add-fund-pin" type="number" name="pin" placeholder="PIN (4 digit)" formnovalidate/>
                    </div>
                    <br/>
                    <br/>
                    <input onclick="document.getElementById('confirm-funding').style.display = 'none';" type="button" name="cancel" value="Cancel" style="background-color:#222;"/>
                    <input onclick="confirm_fund();" type="submit" name="submit" value="Confirm"/>
                </div>
            </div>
        </div>
    </div>
        
        
    </form>
</div>


