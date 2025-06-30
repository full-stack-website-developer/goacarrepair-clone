<?php
    declare(strict_types=1);

    // Enable full error reporting
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once('../config/constants.php');
    require_once('../helper/helper.php');

    $url = $_SERVER['REQUEST_URI'];

    switch ($url) {
        case str_starts_with($url, '/admin'):
            require_once('adminRoutes.php');
            break;
        case '/': 
            view('home');
            break;
        case '/contact':
            view('contact');
            break;
        case '/gallery':
            view('gallery');
            break;
        case '/services':
            view('services');
            break;
        case '/about':
            view('about');
            break;
        default:
            die('Page not found');
    }
?>