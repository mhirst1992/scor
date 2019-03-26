<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
  if ($_GET['param'] != ""){
    $driverID[0] = $_GET['param'];
  } else {
    $sql = "SELECT uniqueID FROM core_Drivers WHERE userID = " . $_SESSION['userID'];
    $result = $link->query($sql);
    if (($driverID = $result->fetch_array(MYSQLI_NUM)) == NULL) {
        $driverID[0] = 0;
    } else {
        //Continue
    }
  }

  $sql = "SELECT core_Drivers.userID, core_Users.displayname, core_Drivers.firstname, core_Drivers.lastname, core_Drivers.drivernumber, " .
                "core_Drivers.hometown, core_Drivers.archetype, core_Drivers.sponsor1, core_Drivers.sponsor2, core_Drivers.careerpath, " .
                "core_Drivers.TPE, core_Drivers.APE, core_Drivers.AERO, core_Drivers.AGG, core_Drivers.CHA, core_Drivers.CON, " . 
                "core_Drivers.ENG, core_Drivers.FIN, core_Drivers.QUA, core_Drivers.RDC, core_Drivers.SHT, core_Drivers.SDY, core_Drivers.SSY FROM core_Drivers " . 
                "INNER JOIN core_Users ON core_Users.userID = core_Drivers.userID " . 
                "WHERE core_Drivers.uniqueID = " . $driverID[0];
  $result = $link->query($sql);
    if (($driver = $result->fetch_array(MYSQLI_NUM)) == NULL) {
      //Do these things
      echo "<script>loadcontent('/web/createadriver.php', '#id-yourdriver');</script>";
    } else {
      //Carry on Loading the page.
    }

  $sql = "SELECT name FROM core_Sponsors WHERE sponsorID = " . ($driver[7]);
  $result = $link->query($sql);
  $primary = $result->fetch_array(MYSQLI_NUM);
  $sql = "SELECT name FROM core_Sponsors WHERE sponsorID = " . ($driver[8]);
  $result = $link->query($sql);
  $secondary = $result->fetch_array(MYSQLI_NUM);

?>
<script>
    document.title = "<?php echo $driver[2] . " " . $driver[3]; ?> | SCOR.Manager";
</script>


<div id="content" class="container">

  <div class="row">
    <div class="col-lg-6">
      <div class="card mb-2">
        <img class="card-img-top" src="https://www.nascar.media/wp-content/uploads/sites/7/2017/01/Silhouette.png" alt="Driver Image" style="max-width:80%;">
        <div id="sponsors" style="width: 120px; height: 200px; position: absolute; right: 10px; top: 10px;">
            <img id="spnsrimg1" class="card-img-top" src="img/sponsors/logo_sm/<?php echo $driver[7]; ?>.png" alt="sponsor1" style="width: 100%; height: 50%; padding-bottom: 10px;">
            <img id="spnsrimg2" class="card-img-top" src="img/sponsors/logo_sm/<?php echo $driver[8]; ?>.png" alt="sponsor2" style="width: 100%; height: 50%; padding-bottom: 10px;">
        </div>
        
        <hr class="my-1">
        <div class="card-body pt-2">
          <h5 class="card-title w-100 d-inline-block">
            <div class="w-50 d-inline-block"><?php echo $driver[2] . " " . $driver[3]; ?></div>
            <div class="d-inline-block">
            <span class="badge badge-primary d-inline-block">TPE: <?php echo $driver[10]; ?></span>
            <span class="badge badge-info d-inline-block">APE: <?php echo $driver[11]; ?></span>
            </div>
          </h5>
          
          <table class="w-100">
            <tbody>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Driver Number:</th>
                <td class="p-1 border-top-0"><?php echo $driver[4]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Hometown:</th>
                <td class="p-1 border-top-0"><?php echo $driver[5]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Career Path:</th>
                <td class="p-1 border-top-0"><?php if($driver[9] = 1){echo "Stock Car";}else{echo "Open Wheel";}; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Archetype:</th>
                <td class="p-1 border-top-0"><?php if($driver[6] = 1){echo "Engineer";}else{echo "Wheelman";}; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">1st Sponsor:</th>
                <td class="p-1 border-top-0"><?php echo $primary[0]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">2nd Sponsor:</th>
                <td class="p-1 border-top-0"><?php echo $secondary[0]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">User:</th>
                <td class="p-1 border-top-0"><?php echo $driver[1]; ?></td>
              </tr>
            </tbody>
          </table>
          
        </div> <!-- End of Card-Body -->
      </div> <!-- End of Card -->
      
      
      <div class="card">
        <div class="card-body pt-3">
          <h5 class="card-title">Attributes
          <?php 
            if($driver[0] == $_SESSION['userID']){
              echo "<button type=\"button\" class=\"btn btn-sm btn-success float-right\" onclick=\"loadcontent('/web/driverupdate.php', ''," . $driverID[0] . ");\">Update <i data-feather=\"file-plus\"></i></button>";
            }
          ?>
          </h5>
          <hr>
          
          
          <table class="w-100">
            <tbody>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Aerodynamics:</th>
                <td class="p-1 border-top-0"><?php echo $driver[12]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Aggression:</th>
                <td class="p-1 border-top-0"><?php echo $driver[13]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Chassis:</th>
                <td class="p-1 border-top-0"><?php echo $driver[14]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Consistency:</th>
                <td class="p-1 border-top-0"><?php echo $driver[15]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Engine:</th>
                <td class="p-1 border-top-0"><?php echo $driver[16]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Finishing:</th>
                <td class="p-1 border-top-0"><?php echo $driver[17]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Qualifying:</th>
                <td class="p-1 border-top-0"><?php echo $driver[18]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Road Course:</th>
                <td class="p-1 border-top-0"><?php echo $driver[19]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Short Track:</th>
                <td class="p-1 border-top-0"><?php echo $driver[20]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Speedway:</th>
                <td class="p-1 border-top-0"><?php echo $driver[21]; ?></td>
              </tr>
              <tr>
                <th class="p-1 border-top-0 w-50" scope="row">Super Speedway:</th>
                <td class="p-1 border-top-0"><?php echo $driver[22]; ?></td>
              </tr>
            </tbody>
          </table>
        </div> <!-- End of Card Body -->
      </div> <!-- End of Card -->
      
      
    </div>
    <!--End of Column 1-->
    
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body p-3">
          <h5 class="card-title">Actions</h5>
          <hr>
          <?php
          //echo "<button type=\"button\" class=\"btn btn-dark btn-block rounded-0\" data-toggle=\"modal\" data-target=\"#logModal\">View Player Log</button>";
          if($driver[0] == $_SESSION['userID']){
            echo "<button type=\"button\" class=\"btn btn-success btn-block rounded-0\" onclick=\"loadcontent('/web/driverupdate.php', ''," . $driverID[0] . ");\">Update</button>";
          }
          ?>
        </div>
      </div>
        
    </div>
    <!--End of Column 2-->
  </div>
</div>