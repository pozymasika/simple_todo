<?php
    /**The database configuration file.
    *Enter your own details here.
    */
    define('DB_DSN','mysql:host=localhost;dbname=users');
    define('DB_USER','root');
    define('DB_PASS','sarahn9347');

    //conncet to the database
    global $db;
    $db = new PDO(DB_DSN,DB_USER,DB_PASS);
    $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
