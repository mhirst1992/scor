<?php


/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'xxxxx');
define('DB_PASSWORD', 'xxxxx');
define('DB_NAME', 'scor_db');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$GLOBALS['link'] = $link; 

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Surely all the world is UTF-8 these days?
if (!$link->set_charset("utf8")) {
    die("Failed to set charset encoding: " . $link->error);
}

?>
