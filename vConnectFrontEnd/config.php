<?php
    define('DBSERVER', 'localhost');
    define('DBUSERNAME', 'user');
    define('DBPASSWORD', 'password');
    define('DBNAME', database);

    $db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

    if($db === false){
        die("Error: " . mysqli_connect_error());
    }
?>