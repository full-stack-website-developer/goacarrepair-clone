<?php
    // Absolute file system paths
    define('BASE_PATH', dirname(__DIR__));
    define('PUBLIC_PATH', BASE_PATH . '/public/');
    define('VIEWS_PATH', BASE_PATH . '/resources/views/');
    define('UPLOAD_PATH', PUBLIC_PATH . '/uploads/');

    // URL paths (for browser access)
    define('BASE_URL', 'http://localhost:8001/');
    define('ASSETS_URL', BASE_URL . 'assets/');
    define('UPLOAD_URL', BASE_URL . 'uploads/');
?>
