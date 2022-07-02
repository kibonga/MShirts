<?php

define("WEBISTE", "MShirts");

define("HOST", "localhost");
define("USER", "pavle");
define("PASS", "mshirtspass");
define("NAME", "mshirts");

try {
    $host = HOST;
    $user = USER;
    $pass = PASS;
    $dbname = NAME;

    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8"; 
    $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    $conn = new PDO($dsn, $user, $pass, $options);
}
catch(PDOException $e) {
    echo "Could not connect to Database: " . $e->getMessage();
}
