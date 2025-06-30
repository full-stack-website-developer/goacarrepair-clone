<?php
    function view($path): void
    {
        include_once(VIEWS_PATH . $path . '.php');
    }

    function assets($path): string
    {
        return ASSETS_URL . $path ;
    }

?>