<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
  
  $zero = 0;
  $tpe = $ape = 45;
  
  $sql = "INSERT INTO core_Drivers " . 
         "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        if(mysqli_stmt_bind_param($stmt, "iissisiiiiiiiiiiiiiiiii",
                                  $zero,
                                  $_POST['userid'],
                                  $_POST['firstname'],
                                  $_POST['lastname'],
                                  $_POST['prefnumber'],
                                  $_POST['hometown'],
                                  $_POST['archetype'],
                                  $_POST['sponsor1'],
                                  $_POST['sponsor2'],
                                  $_POST['careerpath'],
                                  $tpe,
                                  $ape,
                                  $_POST['AERO'],
                                  $_POST['AGG'],
                                  $_POST['CHA'],
                                  $_POST['CON'],
                                  $_POST['ENG'],
                                  $_POST['FIN'],
                                  $_POST['QUA'],
                                  $_POST['RDC'],
                                  $_POST['SHT'],
                                  $_POST['SDY'],
                                  $_POST['SSY'])){
          if(mysqli_stmt_execute($stmt)){
            //Successful Driver Creation!
            $lastid = $link->insert_id;
            LogFile("newfile.txt", "New Driver Created! - " . $lastid);
          } else {
            LogFile("newfile.txt", "Create Driver PHP Error: " .$link->error);  
          }
        } else {
          LogFile("newfile.txt", "Create Driver PHP Failed to Bind: " .$link->error);  
        }
  } else {
    LogFile("newfile.txt", "Create Driver PHP Failed to Prepare Statement. " . $link->error);
  }
  
  //Create new task.
  $name = "New Driver: " . $_POST['firstname'] . " " . $_POST['lastname'];
  $userID = $_SESSION['userID'];
  
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
        LogFile("newfile.txt", "New Task Created! - " . $name);
      } else {
        LogFile("newfile.txt", "Create Task New Driver PHP Error: " .$link->error);  
      }
    } else {
      LogFile("newfile.txt", "Create Task New Driver PHP Failed to Bind: " .$link->error);  
    }
  } else {
      LogFile("newfile.txt", "Create Task New Driver PHP Failed to Prepare: " .$link->error);
  }


?>