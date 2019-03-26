<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
  
$aNames = array("TPE","APE","Aerodynamics","Aggression","Chassis","Consistency","Engine","Finishing","Qualifying","Road Course","Short Track","Speedway","Superspeedway");
$cnt = 10;
  
$att = array();
for ($i=0;$i<sizeof($aNames);$i++){
  $att[$cnt] = $aNames[$i];
  $cnt++;
}

$spon = array();
$sql = "SELECT sponsorID, name FROM core_Sponsors";
$result = $link->query($sql);
while (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
  $spon[$row[0]] = $row[1];
}

  
$sql = "SELECT * FROM core_Drivers WHERE userID = " . $_POST['userid'];
$result = $link->query($sql);
  if (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
      
      if($row[6] == 1){
          $row[6] = "Engineer"; 
      } else {
          $row[6] = "Wheel Man";
      }
      if($row[9] == 1){
          $row[9] = "Stockcar"; 
      } else {
          $row[9] = "Open Wheel";
      }

      echo "<table class=\"table table-borderless table-sm\">";
        echo "<tbody>";
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">Driver Number:</th>";
            echo "<td> " . $row[4] . " </td>";
          echo "</tr>";
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">Hometown:</th>";
            echo "<td> " . $row[5] . " </td>";
          echo "</tr>";
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">Archetype:</th>";
            echo "<td> " . $row[6] . " </td>";
          echo "</tr>";
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">Career Path:</th>";
            echo "<td> " . $row[9] . " </td>";
          echo "</tr>";
        echo "</tbody>";
      echo "</table>";
      
      echo "<hr>";
      
      echo "<table class=\"table table-borderless table-sm\">";
        echo "<tbody>";
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">Sponsor 1:</th>";
            echo "<td> " . $spon[$row[7]] . " </td>";
          echo "</tr>";
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">Sponsor 2:</th>";
            echo "<td> " . $spon[$row[8]] . " </td>";
          echo "</tr>";
        echo "</tbody>";
      echo "</table>";

      echo "<hr>";
      
      echo "<table class=\"table table-borderless table-sm\">";
        echo "<tbody>";
        for ($i=10;$i<sizeof($row);$i++){
          echo "<tr>";
            echo "<th scope=\"row\" class=\"w-50\">" . $att[$i] . ":</th>";
            echo "<td> " . $row[$i] . " </td>";
          echo "</tr>";
        }  
        echo "</tbody>";
      echo "</table>";
  }
  
?>