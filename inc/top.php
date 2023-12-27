<?php if(!isset($is_inc)) { http_response_code(403); exit; } elseif($is_inc !== INC_NUMBER) { http_response_code(403); exit; }; ?>
<div class="layout-top">
    <div class="up">
        <div>
            <span>
                <img src="<?php HOST_ROOT() ?>assets/images/logo.png" width="50" alt="Logo" class="logo"/>
            </span>
            <h1 class="heading">BANK PROJECT</h1>
        </div>
        <div>
            <?php 
                if(DEVICE == 'mobile') {
                    ?>
                        <button class="menu-mobile" title="Open Menu" onclick="mobileOpenMenu();">
                            <i class="bi bi-list"></i>
                        </button>
                    <?php
                } elseif(DEVICE == 'desktop') {
                    ?>
                        <nav class="layout-top-nav">
                            <ul>
                                <li> <a href="<?php HOST_ROOT(); ?>">HOME</a> </li>
                                <li> <a href="<?php HOST_ROOT(); ?>about.html">ABOUT US</a> </li>
                                <li> <a href="<?php HOST_ROOT(); ?>contact_us.html">CONTACT US</a> </li>
                                <li> <a href="<?php HOST_ROOT(); ?>news.html">NEWS</a> </li>
                                <li> <?php echo $bank_login_link; ?> </li>
                            </ul>
                        </nav>
                    <?php
                }
            ?>
        </div>
    </div>
    <?php if(DEVICE == "tablet") { ?>
    <div class="down">
        <nav class="layout-top-nav">
            <ul>
                <li> <a href="<?php HOST_ROOT(); ?>">HOME</a> </li>
                <li> <a href="<?php HOST_ROOT(); ?>about.html">ABOUT US</a> </li>
                <li> <a href="<?php HOST_ROOT(); ?>contact_us.html">CONTACT US</a> </li>
                <li> <a href="<?php HOST_ROOT(); ?>news.html">NEWS</a> </li>
                <li> <?php echo $bank_login_link; ?> </li>
            </ul>
        </nav>
    </div>
    <?php }elseif(DEVICE == 'mobile') { ?>
    <div class="down">
        <nav class="layout-top-nav" id="mobile-menu">
            <ul>
                <li> <a href="<?php HOST_ROOT(); ?>">HOME</a> </li>
                <li> <a href="<?php HOST_ROOT(); ?>about.html">ABOUT US</a> </li>
                <li> <a href="<?php HOST_ROOT(); ?>contact_us.html">CONTACT US</a> </li>
                <li> <a href="<?php HOST_ROOT(); ?>news.html">NEWS</a> </li>
                <li> <?php echo $bank_login_link; ?> </li>
            </ul>
        </nav>
    </div>
    <?php } ?>
</div>