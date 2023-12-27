<?php if(!isset($is_inc)) { http_response_code(403); exit; } elseif($is_inc !== INC_NUMBER) { http_response_code(403); exit; }; ?>
<h1>Add New Customers</h1>
<h2>Please fill the following details...</h2>
<hr/>
<form onsubmit="return false;" method="post" action="" class="layout-form">
    <br/>
    <b>Info</b><br/>
    <label class="wrap-icon-input wrap-icon-input-2">
        <span class="icon"> <i class="bi bi-person"></i> </span>
        <input id="new-customer-firstname" type="text" name="firstname" placeholder="First name" />
        <!-- <input id="new-customer-midlename" type="text" name="midlename" placeholder="Midle Name" /> -->
        <input id="new-customer-lastname" type="text" name="midlename" placeholder="Last Name" />
    </label><br />

    <b>Gender</b><br/>
    <label class="wrap-icon-input wrap-icon-input-3 checkable">
        <span class="icon"> <i class="bi bi-gender-ambiguous"></i> </span>
        <input type="text" name="" value="Female" disabled/>
        <input id="new-customer-gender-f" type="radio" name="gender" value="female"/>
        <input type="text" name="" value="Male" disabled/>
        <input id="new-customer-gender-m" type="radio" name="gender" value="male"/>
        <!-- <input type="text" name="" value="Other" disabled/>
        <input id="new-customer-gender-o" type="radio" name="gender" value="other"/> -->
    </label><br /><br />

    <b>Birthday</b><br/>
    <label class="wrap-icon-input wrap-icon-input-mobile-full wrap-icon-input-same-desktop">
        <span class="icon"> <i class="bi bi-calendar-plus"></i> </span>
        <input id="new-customer-birthday" type="date" name="birthday"/>
    </label><br /><br />

    <b>Contact Info</b><br/>
    <label class="wrap-icon-input wrap-icon-input-mobile-full wrap-icon-input-same-desktop">
        <span class="icon"> <i class="bi bi-person-badge"></i> </span>
        <input id="new-customer-email" type="email" name="email" placeholder="Email-ID"/>
        <input id="new-customer-phone" type="tel" name="phone" placeholder="Phone Number"/>
    </label><br /><br />

    <b>Opening</b><br/>
    <label class="wrap-icon-input wrap-icon-input-mobile-full wrap-icon-input-same-desktop">
        <span class="icon"> <i class="bi bi-activity"></i> </span>
        <input id="new-customer-balance" type="number" name="balance" placeholder="Opening balance (USD 5)"/>
        <input id="new-customer-pin" type="number" name="pin" placeholder="PIN(4 digit)"/>
    </label><br /><br />

    <b>Login</b><br/>
    <label class="wrap-icon-input wrap-icon-input-mobile-full wrap-icon-input-same-desktop">
        <span class="icon"> <i class="bi bi-key"></i> </span>
        <input id="new-customer-username" type="text" name="username" placeholder="Username"/>
        <input id="new-customer-password" type="password" name="password" placeholder="Password"/>
    </label><br /><br />

    <input onclick="validate_new_customer();" type="submit" name="submit" value="Submit" />
    <br />
    <br />
</form>
