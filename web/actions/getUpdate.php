<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
  
$aNames = array("TPE","APE","Aerodynamics","Aggression","Chassis","Consistency","Engine","Finishing","Qualifying","Road Course","Short Track","Speedway","Superspeedway");
$cnt = 6;
  
$att = array();
for ($i=0;$i<sizeof($aNames);$i++){
  $att[$cnt] = $aNames[$i];
  $cnt++;
}
    
    
    
      echo "<h5>Point Tasks</h5>";
      echo "<table class=\"table table-borderless table-sm\">";
        echo "<tbody>";

$totale = 0;
$sql = "SELECT task, tasktpe, taskurl FROM core_Updates WHERE updated = 0 AND userID = " . $_POST['userid'];
$result = $link->query($sql);
  while (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
      //http:// the urls
      if (substr( $row[2], 0, 4 ) != "http"){
        $url = "http://" . $row[2];
      } else {
        $url = $row[2];
      }
      
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\"><a href=\"" . $url . "\">" . $row[0] . "</a></th>";
            echo "<td> " . $row[1] . " </td>";
          echo "</tr>";
          $totale += $row[1];
  }
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">Total Earned</th>";
            echo "<td> " . $totale . " </td>";
          echo "</tr>";
  
        echo "</tbody>";
      echo "</table>";
      echo "<h5>Point Tasks</h5>";
      echo "<table class=\"table table-borderless table-sm\">";
      echo "<tbody>";
$sql = "SELECT * FROM core_Updates WHERE updated = 0 AND userID = " . $_POST['userid'];
$result = $link->query($sql);
  if (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
      //http:// the urls
        for ($i = 6; $i < sizeof($row)-15; $i++ ){
          if ($row[$i] != $row[$i+13]){
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">" . $att[$i] . ":</th>";
            echo "<td> " . $row[$i+13] . "-><span class=\"text-success\">" . $row[$i] . " </span></td>";
          echo "</tr>";
          }
        }
  }  
  
?>