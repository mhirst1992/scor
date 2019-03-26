<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

$colNames = ["TPE","APE","AERO","AGG","CHA","CON","ENG","FIN","QUA","RDC","SHT","SDY","SSY"];



$sql = "SELECT * FROM core_Updates WHERE updated = 0 AND userID = " . $_POST['user'];
$result = $link->query($sql);
if (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
  
  $newval = array();
  $n = 0;
  for ($i = 6; $i < 19; $i++){
    $newval[$n] = $row[$i];  
    $n++;
  }
}

$sql = "UPDATE core_Drivers SET ";
for ($i = 0; $i < sizeof($newval)-1;$i++){
  $sql .= $colNames[$i] . " = " . $newval[$i]  . ", ";
}
$sql .= $colNames[sizeof($newval)-1] . " = " . $newval[sizeof($newval)-1]  . " ";
$sql .= " WHERE userID = " . $_POST['user'];
//Created the SQL Statement, now do it.
if($stmt = $link->prepare($sql)){
  if (mysqli_stmt_execute($stmt)) {
    //It worked!
  } else {
    LogFileAndDie("newfile.txt", "approveupdate: update core_Drivers failed: " . $stmt->error);
  }
} else {
  LogFileAndDie("newfile.txt", "approveupdate: prepare of update core_Drivers failed: " . $link->error);
}


$sql = "UPDATE core_Updates SET updated = 1 WHERE updated = 0 AND userID = " . $_POST['user'];
if($stmt = $link->prepare($sql)){
  if (mysqli_stmt_execute($stmt)) {
    //It worked!
  } else {
    LogFileAndDie("newfile.txt", "approveupdate: update updated value failed: " . $stmt->error);
  }
} else {
  LogFileAndDie("newfile.txt", "approveupdate: prepare of update updated value failed: " . $link->error);
}





?>
