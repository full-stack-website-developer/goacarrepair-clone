<?php 


function getConnection()
{
    $server = DB_SERVER;
    $user_name = DB_USERNAME;
    $password = PASSWORD;
    $db_name = DB_NAME;

    $dsn = "mysql:host=$server;dbname=goa_project";

    try {
        $conn = new PDO($dsn, $user_name, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    // var_dump($conn);
    // die;

    return $conn;

}


   
?>