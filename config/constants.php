<?php
    //Start session
    session_start();
    

    //Create constant to store non repeating values
    define('SITEURL', 'http://localhost/CanteenMgmt/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'Ruzan');
    define('DB_NAME', 'canteenmgmt');
    
    $conn =  mysqli_connect(LOCALHOST , DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

?>