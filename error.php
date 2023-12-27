<?php

    switch(@$_GET["ert"]) {
        case 'l':
            echo 'Oops! Something went wrong while trying to log you in.';
        break;
        default:
            echo 'Oops! That\'s an error.';
    }