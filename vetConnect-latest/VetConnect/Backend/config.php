<?php
    //created by Kaitlin Culligan on 03/26/22
    //this file configures the connection to the database for all other php scripts
    define('DBSERVER', 'localhost');
    define('DBUSERNAME', 'user');
    define('DBPASSWORD', 'password');
    define('DBNAME', database);

    $db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

    if($db === false){
        die("Error: " . mysqli_connect_error());
    }
?>