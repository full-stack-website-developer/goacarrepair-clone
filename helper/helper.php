<?php
    function view($path): void
    {
        $file = VIEWS_PATH . $path . '.php';
        if (file_exists($file)) {
            include_once($file);
        }
        else {
            echo "View FIle Not Found: $file";
        }
    }

    function viewAdmin($path): void
    {
        $file = ADMIN_VIEWS_PATH . $path . '.php';
        if (file_exists($file)) {
            include_once($file);
        }
        else {
            echo "View FIle Not Found: $file";
        }
    }

    function assets($path): string
    {
        return ASSETS_URL . $path ;
    }

    function layouts($path) : void
    {
        include_once(LAYOUT_PATH . $path . '.php');
    }
?>