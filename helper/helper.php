<?php
    function view($path, $data = []): void
    {
        $file = VIEWS_PATH . $path . '.php';

        if (file_exists($file)) {
              extract($data);
            include_once($file);
        }
        else {
            echo "View FIle Not Found: $file";
        }
    }
        
    function messages($path) : void{
        $file = MESSAGES_PATH. $path . '.php';
        if (file_exists($file)) {
            include_once($file);
        } else{
            echo "Not Found";
        };
    }



    function viewAdmin($path, mixed $data = []): void
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



    function redirect($path) : void
    {
        header('Location: ' . $path);
        exit;
    }

?>