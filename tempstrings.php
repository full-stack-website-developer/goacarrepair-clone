<?php 
    if (isset($_POST['submit'])) {
        echo "<pre>";

        print_r($_POST);
        // die;

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="team[][name]" placeholder="Enter Name">
        <input type="text" name="team[][gender]" placeholder="Enter Name">
        <input type="text" name="team[][name]" placeholder="Enter Name">
        <input type="text" name="team[][gender]" placeholder="Enter Name">
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>