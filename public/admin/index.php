<?php
    declare(strict_types=1);

    // Enable full error reporting
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once('../../config/constants.php');
    require_once(BASE_PATH . '/helper/helper.php');

    $url = $_SERVER['REQUEST_URI'];

    switch ($url) {
        case '/admin': 
            view('admin/dashboard');
            break;
        case '/admin/services':
            view('/admin/services/show');
            break;
        case '/admin/services/create':
            view('/admin/services/create');
            break;
        default:
            die('Page not Found');
    }
?>