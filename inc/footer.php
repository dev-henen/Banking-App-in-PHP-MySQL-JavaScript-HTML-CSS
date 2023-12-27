<?php if(!isset($is_inc)) { http_response_code(403); exit; } elseif($is_inc !== INC_NUMBER) { http_response_code(403); exit; }; ?>
<footer class="layout-footer">
    <div>
        <div class="links">
            <nav>
                <ul>
                    <li> <a href="<?php HOST_ROOT(); ?>">Home</a> </li>
                    <li> <a href="<?php HOST_ROOT(); ?>about.html">About us</a> </li>
                    <li> <a href="<?php HOST_ROOT(); ?>contact_us.html">Contact us</a> </li>
                </ul>
                <ul>
                    <li> <a href="<?php HOST_ROOT(); ?>news.html">News</a> </li>
                    <li> <a href="<?php HOST_ROOT(); ?>login.html">Blog</a> </li>
                    <li> <a href="<?php HOST_ROOT(); ?>login.html">Privacy/Policy</a> </li>
                </ul>
            </nav>
        </div>
        <div class="social">
            <a href="#f" title="Follow us on facebook"> <i class="bi bi-facebook"></i> </a>
            <a href="#t" title="Follow us on twitter"> <i class="bi bi-twitter"></i> </a>
            <a href="#l" title="Follow us on linkedin"> <i class="bi bi-linkedin"></i> </a>
        </div>
    </div>
    <div class="copyright">
        <p> &copy; <?php echo date('Y'); ?> <?php echo strtoupper(APP_NAME); ?> all rights reserved. </p>
    </div>
</footer>