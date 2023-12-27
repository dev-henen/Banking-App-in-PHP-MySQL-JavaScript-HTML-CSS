<?php if(!isset($is_inc)) { http_response_code(403); exit; } elseif($is_inc !== INC_NUMBER) { http_response_code(403); exit; }; ?>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="<?php HOST_ROOT(); ?>libs/bootstrap/bootstrap-icons.css"/>
<link rel="stylesheet" type="text/css" href="<?php HOST_ROOT(); ?>assets/css/layout.css"/>
<?php 
    switch(DEVICE) {
        case 'mobile':
            ?>
            <link rel="stylesheet" type="text/css" href="<?php HOST_ROOT(); ?>assets/css/mobile.css"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php
        break;
        case 'tablet':
            ?>
            <link rel="stylesheet" type="text/css" href="<?php HOST_ROOT(); ?>assets/css/tablet.css"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.1">
            <?php
        break;
        case 'desktop':
            ?>
            <link rel="stylesheet" type="text/css" href="<?php HOST_ROOT(); ?>assets/css/desktop.css"/>
            <?php
        break;
    }
?>
    
