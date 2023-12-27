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
                        <button class="menu-mobile" title="Open Menu" onclick="openLeftDashboard()">
                            <i class="bi bi-list"></i>
                        </button>
                    <?php
                } elseif(DEVICE == 'desktop') {
                    ?>
                        <nav class="layout-top-nav">
                            <ul>
                                <li> <a href="<?php HOST_ROOT(); ?>">HOME</a> </li>
                                <li> <a href="<?php HOST_ROOT(); ?>logout"> <i class="bi bi-door-open"></i> Logout</a> </li>
                            </ul>
                        </nav>
                    <?php
                }
            ?>
        </div>
    </div>
    </div>
    <?php if(DEVICE == 'tablet') { ?>
    <div class="down">
        <nav class="layout-top-nav" id="mobile-menu">
            <ul>
                <li> <a href="<?php HOST_ROOT(); ?>">HOME</a> </li>
                <li> <a href="<?php HOST_ROOT(); ?>logout"> <i class="bi bi-door-open"></i> Logout</a> </li>
            </ul>
        </nav>
    </div>
    <?php } ?>
</div>