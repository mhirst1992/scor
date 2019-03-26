<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';


$sql = "UPDATE core_Tasks SET approved = 1 WHERE taskID = " . $_POST['task'];
if($stmt = $link->prepare($sql)){
    if (mysqli_stmt_execute($stmt)) {
        //LogFile("newfile.txt", "saveupdate: delete successful");
    } else {
        LogFileAndDie("newfile.txt", "approveTask: update to approved failed: " . $stmt->error);
    }
} else {
    LogFileAndDie("newfile.txt", "approveTask: prepare of set to approved failed: " . $link->error);
}
?>
