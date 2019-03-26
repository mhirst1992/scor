<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

// First delete any old entries

$sql = "DELETE FROM core_Updates WHERE driverID = ".$_POST['driverID'] ." AND updated = 0";
if($stmt = $link->prepare($sql)){
    if (mysqli_stmt_execute($stmt)) {
        //LogFile("newfile.txt", "saveupdate: delete successful");
    } else {
        LogFileAndDie("newfile.txt", "saveupdate: delete failed: " . $stmt->error);
    }
} else {
    LogFileAndDie("newfile.txt", "saveupdate: prepare of delete failed: " . $link->error);
}

$sql = "INSERT INTO core_Updates " .
    "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)";
//                   5 6       10                  20        25        30
$zero = 0;
$counter = 0;

// Loop adding new or updated entries

while (isset($_POST['task' . $counter])) {
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
    
        if (mysqli_stmt_bind_param($stmt, "iiisisiiiiiiiiiiiiiiiiiiiiiiiiiii", $zero,
            $_POST['driverID'], $_POST['userID'], 
            $_POST['task' . $counter], $_POST['taskTPE' . $counter], $_POST['taskURL' . $counter],
            $_POST['tpe'], $_POST['ape'], $_POST['aero'], $_POST['agg'], $_POST['cha'], $_POST['con'],
            $_POST['eng'], $_POST['fin'], $_POST['qua'], $_POST['rdc'], $_POST['sht'], $_POST['sdy'],
            $_POST['ssy'], 
            $_POST['o_tpe'], $_POST['o_ape'], $_POST['o_aero'], $_POST['o_agg'], $_POST['o_cha'],
            $_POST['o_con'], $_POST['o_eng'], $_POST['o_fin'], $_POST['o_qua'], $_POST['o_rdc'], 
            $_POST['o_sht'], $_POST['o_sdy'], $_POST['o_ssy'], $zero)) {
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                LogFile("newfile.txt", "saveupdate: update " . $counter . " successful");
                $ids[$counter] = $link->insert_id;
            } else {
                LogFileAndDie("newfile.txt", "saveupdate: execute failed: " . $stmt->error);
            }
        } else {
            LogFileAndDie("newfile.txt", "saveupdate: bind failed: " . $stmt->error);
        }
    } else {
        LogFileAndDie("newfile.txt", "saveupdate: prepare update failed: " . $link->error);
    }
    $counter++;
}

$sql = "DELETE FROM core_Tasks WHERE userID = ".$_SESSION['userID'] ." AND name LIKE '%New Update%' AND approved = 0";
if($stmt = $link->prepare($sql)){
    if (mysqli_stmt_execute($stmt)) {
        //LogFile("newfile.txt", "saveupdate: delete successful");
    } else {
        LogFileAndDie("newfile.txt", "saveupdate: delete pending task failed: " . $stmt->error);
    }
} else {
    LogFileAndDie("newfile.txt", "saveupdate: prepare of delete pending task failed: " . $link->error);
}

$sql = "SELECT firstname, lastname FROM core_Drivers WHERE userID = " . $_SESSION['userID'];
$result = $link->query($sql);
    if (($n = $result->fetch_array(MYSQLI_NUM)) != NULL) {
      //Do these things
      $name = $n[0] . " " . $n[1]; 
    } else {
      $name = "Error finding driver in the database. USER ID: " . $_SESSION['userID'];
    }


//Create new task.
  $name = "New Update: " . $name;
  $userID = $_POST['userID'];
  
  
  $sql = "INSERT INTO core_Tasks " . 
         "VALUES (?,?,?,?)";
  if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    if(mysqli_stmt_bind_param($stmt, "isii",
                              $zero,
                              $name,
                              $userID,
                              $zero)){
    if(mysqli_stmt_execute($stmt)){
        //Successful Task Creation!
        //LogFile("newfile.txt", "New Task Created! - " . $name);
      } else {
        LogFile("newfile.txt", "Create Task New Update PHP Error: " .$link->error);  
      }
    } else {
      LogFile("newfile.txt", "Create Task New Update PHP Failed to Bind: " .$link->error);  
    }
  } else {
      LogFile("newfile.txt", "Create Task New Update PHP Failed to Prepare: " .$link->error);
  }




?>