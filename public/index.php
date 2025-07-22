<?php
    declare(strict_types=1);

    session_start();

    // Enable full error reporting
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once('../config/constants.php');
    require_once('../config/database.php');
    require_once('../helper/helper.php');


    $url = $_SERVER['REQUEST_URI'];
    $url = parse_url($url, PHP_URL_PATH);

    switch ($url) {
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
        case '/blog':
            view('blog');
            break;
            
        default:
        if (preg_match('#^/services/(.+)$#', $url, $matches)) {
            $slug = $matches[1];
            $_GET['slug'] = $slug;
            view('singleService');

        } elseif (preg_match('#^/blog/(.+)$#', $url, $matches)) {
            $slug = $matches[1];
            $_GET['slug'] = $slug;
            view('singleBlog');

        } else {
            die('Page not found');
        }
        break;
    }
?>