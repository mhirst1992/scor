<?php
ini_set('display_errors', '1');
require_once $_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/config.php';


if (! isset($signin_page)) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        // echo session_status();
    }
    // If session variable is not set it will redirect to login page
    if (! isset($_SESSION['userID']) || empty($_SESSION['userID'])) {
        header("location: /web/session/signin.php");
        exit();
    }
}




function LogFile($filename, $text)
{
    $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/logs/misc/" . $filename, "a") or die("Unable to open file!");
    fwrite($myfile, date('Y/m/d H:i:s') . ": " . $text . "\n");
    fclose($myfile);
}

function LogFileAndDie($filename, $text)
{
    LogFile($filename, $text);
    die("<h2 class=\"pt-5\">INTERNAL ERROR:</h2>" . htmlspecialchars($text));
}


?>