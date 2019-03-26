<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';


$sql = "SELECT uniqueid FROM core_Drivers WHERE userID = " . $_POST['userid'];
$result = $link->query($sql);
if (($id = $result->fetch_array(MYSQLI_NUM)) != NULL) {
  echo $id[0];
}
?>
