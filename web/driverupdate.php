<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
  
  $ID = $_GET['param'];
  
  
  // Fetch driver attributes
  // Note userID is passed in via URL GET param named "param"
  $sql = "SELECT userID, firstname, lastname, archetype, TPE, APE, AERO, AGG, CHA, CON, ENG, FIN, QUA, RDC, SHT, SDY, SSY " .
         "FROM core_Drivers WHERE uniqueID = " . $ID;
  if($stmt = $link->prepare($sql)){
    $stmt->execute();
    $stmt->store_result();
   // echo $stmt->num_rows();
    if($stmt->num_rows() == 1){                    
      $stmt->bind_result($userID, $firstname, $lastname, $archetype, $tpe, $ape, $aero, 
                         $agg, $cha, $con, $eng, $fin, $qua, $rdc, $sht, $sdy, $ssy);
      $stmt->fetch();
    }
  }
  else {
    LogFile("newfile.txt", "Preparing Driver Attributes failed.");
  }
?>

<script>
document.title = "<?php echo $firstname . " " . $lastname; ?> Updates | SCOR.Manager";

// Create JS array taskdata[][] with a row for each currently defined task
// We need the current attribute values from the last row, so we update the
// php cur_* variables for each row we read in.
var taskdata = [

<?php
  $cur_tpe = $tpe;
  $cur_ape = $ape;
  $cur_aero = $aero;
  $cur_agg = $agg;
  $cur_cha = $cha;
  $cur_con = $con;
  $cur_eng = $eng;
  $cur_fin = $fin;
  $cur_qua = $qua;
  $cur_rdc = $rdc;
  $cur_sht = $sht;
  $cur_sdy = $sdy;
  $cur_ssy = $ssy;


  $sql = "SELECT driverID, userID, task, taskTPE, taskURL, TPE, APE, " .
         "AERO, AGG, CHA, CON, ENG, FIN, QUA, RDC, SHT, SDY, SSY, " . //7 - 17
         "updated FROM core_Updates " .
         "WHERE driverID = " . $ID . " AND updated = 0 " .
         "ORDER BY updateID";
       
  $result = $link->query($sql);
  while (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
      if ($row[2] != "DummyTask"){
        echo "{ task:\"",  $row[2], "\", tpe:\"", $row[3],"\", taskURL:\"", $row[4],"\" },";
      }
    $cur_tpe = $row[5]; $cur_ape = $row[6];
    $cur_aero = $row[7]; $cur_agg = $row[8]; $cur_cha = $row[9];
    $cur_con = $row[10]; $cur_eng = $row[11]; $cur_fin = $row[12];
    $cur_qua = $row[13]; $cur_rdc = $row[14]; $cur_sht = $row[15];
    $cur_sdy = $row[16];   $cur_ssy = $row[17];

  }

  $attnames = ["Strength", "Agility", "Arm", "Intelligence", "Accuracy",
                "Tackling", "Speed", "Hands", "Run Blocking", "Pass Blocking",
                "Kick Distance", "Kick Accuracy"]; 
?>

];

var basevals = [<?php echo $aero.",".$agg.",".$cha.",".$con.",".$eng.",".$fin.",".$qua.",".$rdc.",".$sht.",".$sdy.",".$ssy; ?>];
var currvals = [<?php echo $cur_aero.",".$cur_agg.",".$cur_cha.",".$cur_con.",".$cur_eng.",".$cur_fin.",".$cur_qua.",".$cur_rdc.",".$cur_sht.",".$cur_sdy.",".$cur_ssy; ?>];

  var baseAPE = <?php echo $ape; ?>;
  
</script>

<h2 class="pt-4"><?php echo $firstname . " " . $lastname; ?> Updates </h2>


<div class="row">
  
  <!-- Style sets the content width
       required for columned pages. -->
  <style>
    #content {
      max-width: 1000px !important;
    }
  </style>
  
  
  <div class="col-lg-6 my-center">
    
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Point Tasks</h5>
        <p>Add your point tasks below, your TPE earnings will be tallied up automatically so you can apply them in the second column.</p>
        <p>Your update won't be reflected on your player profile until an Admin has entered your update into the sim.</p>
      </div>
    </div>
    
    <div id="pointtaskcontainer">
    
    
    
    
    
    </div>
    

    
    
    <div class="card">
      <div class="card-body">
        <button type="button" class="btn btn-success rounded-0" onclick="createTask()">Add Task</button>
        <button type="button" class="btn btn-danger rounded-0 float-right" onclick="removeTask()">Remove Task</button>
      </div>
    </div>
  
  
  
  </div>
  
  
  <div class="col-lg-6 my-center">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Attributes
        <button type="button" class="btn btn-sm btn-info p-0 pl-1 pr-1" data-toggle="popover" data-trigger="focus" data-html="true" title="TPE Update Scale" 
          

              data-content=
              "
              	25-40: &emsp; &thinsp; 1 TPE per level<br>
		41-50: &emsp; &thinsp; 2 TPE per level<br>
		51-70: &emsp; &thinsp; 3 TPE per level<br>
		71-75: &emsp; &thinsp; 4 TPE per level<br>
		76-80: &emsp; &thinsp; 6 TPE per level<br>
		81-85: &emsp; &thinsp; 8  TPE per level<br>
		86-90: &emsp; 12  TPE per level<br>
		91-95: &emsp; 15  TPE per level <br>
		96-99: &emsp; 18  TPE per level <br>
              "> 
              
              
              TPE Update Scale</button>

        </h5>
        <table class="table table-borderless table-sm border-top-0 w-50">
          <tbody>
            <tr>
              <th scope="row">Available</th>
              <td class="float-right" id="availablepoints"></td>
            </tr>
            <tr>
              <th scope="row">APE</th>
              <td class="float-right" id="appliedpoints"><?php echo $ape; ?></td>
            </tr>
            <tr>
              <th scope="row">TPE</th>
              <td class="float-right" id="totalpoints"><?php echo $tpe; ?></td>
            </tr>
          </tbody>
        </table>
        

        
        
       
        <!-- Aerodynamics -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-AERO"> 
                Aerodynamics
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Aerodynamics" 
                data-content="The ability of the car to slip through the air with a minimum of drag. A higher aero rating means less drag, which translates to more speed."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('0')" id="minusBtn-0" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-0" value="<?php echo $aero; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('0')" id="plusBtn-0">+</button>
          
          </div>
        <!-- Aggression -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-AGG"> 
                Aggression
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Aggression" 
                data-content="Patience level when attempting a pass or blocking. High aggression may increase the chance of driver error."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('1')" id="minusBtn-1" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-1" value="<?php echo $agg; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('1')" id="plusBtn-1">+</button>
          
          </div>
          <!-- Chassis -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-CHA"> 
                Chassis
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Chassis" 
                data-content="The ability at which your car grips through corners and holds their line."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('2')" id="minusBtn-2" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-2" value="<?php echo $cha; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('2')" id="plusBtn-2">+</button>
          
          </div>
          <!-- Consistency -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-CON"> 
                Consistency
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Consistency" 
                data-content="Ability to run consistent laps. Note that it is possible to be consistently slow. Consistency also affects the the chance of driver error."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('3')" id="minusBtn-3" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-3" value="<?php echo $con; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('3')" id="plusBtn-3">+</button>
          
          </div>
          <!-- Engine ENG -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-ENG"> 
                Engine
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Engine" 
                data-content="The effective power your engine can generate. Also referred to in the sim as engine horsepower."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('4')" id="minusBtn-4" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-4" value="<?php echo $eng; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('4')" id="plusBtn-4">+</button>
          
          </div>
          <!-- Finishing FIN -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-FIN"> 
                Finishing
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Finishing" 
                data-content="The ability to finish a race well. Drivers with a high finishing rating will get stronger as the race nears its end."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('5')" id="minusBtn-5" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-5" value="<?php echo $fin; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('5')" id="plusBtn-5">+</button>
          
          </div>
          <!-- Qualifying QUA -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-QUA"> 
                Qualifying
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Qualifying" 
                data-content="This effects the drivers overall performance in qualifying sessions only."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('6')" id="minusBtn-6" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-6" value="<?php echo $qua; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('6')" id="plusBtn-6">+</button>
          
          </div>
          <!-- Road Course RDC -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-RDC"> 
                Road Course
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Road Course" 
                data-content="Performance on road courses."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('7')" id="minusBtn-7" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-7" value="<?php echo $rdc; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('7')" id="plusBtn-7">+</button>
          
          </div>
          <!-- Short Track SHT -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-SHT"> 
                Short Track
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Short Track" 
                data-content="Performance on tracks under one mile in length."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('8')" id="minusBtn-8" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-8" value="<?php echo $sht; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('8')" id="plusBtn-8">+</button>
          
          </div>
          <!-- Speedway SDY -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-SDY"> 
                Speedway
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Speedway" 
                data-content="Performance on ovals between one and two and a half miles which do not mandate the use of a restrictor plate."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('9')" id="minusBtn-9" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-9" value="<?php echo $sdy; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('9')" id="plusBtn-9">+</button>
          
          </div>
          <!-- Super Speedway SSY -->
          <div class="input-group input-group mb-1">
            <div class="input-group-prepend" style="width: 60%;">
              <span class="input-group-text w-100" id="inputGroup-SSY"> 
                Super Speedway
              </span>
              <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" title="Super Speedway" 
                data-content="Performance on ovals of two and a half miles and over, including those at which a restrictor plate is mandated."> 
                <i data-feather="help-circle"></i></button>
              </div>
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('10')" id="minusBtn-10" disabled>-</button>
            <input type="text" class="form-control text-center" disabled id="value-10" value="<?php echo $ssy; ?>">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('10')" id="plusBtn-10">+</button>
          
          </div>

          <button type="button" class="btn btn-primary btn-block mt-3" id="updateBtn" onclick="SaveUpdate()">Save Update</button>
      </div>
    </div>
  </div>
</div>


    <script>
  var counter = 0;
  var inccost = [];
  inccost[0] = [0,0];
  inccost[1] = [0,0];
  inccost[2] = [0,0];
  inccost[3] = [0,0];
  inccost[4] = [0,0];
  inccost[5] = [0,0];
  inccost[6] = [0,0];
  inccost[7] = [0,0];
  inccost[8] = [0,0];
  inccost[9] = [0,0];
  inccost[10] = [0,0];
  inccost[11] = [0,0];

  $(document).ready(function(){
	    var i;
	    
	    for (i = 0; i < taskdata.length; i++) {
	      createTask(taskdata[i]['task'], taskdata[i]['taskURL'], taskdata[i]['tpe']);
	    }
	    
	    for (i = 0; i < 12; i++){
	      $('#value-' + i).val(currvals[i]);
	      var j = 0;
	      var k = 0;
	      if(basevals[i] != currvals[i]){
	        document.getElementById("minusBtn-"+i).classList.remove("disabled");
	        $('#minusBtn-'+i).prop('disabled', false);
	        
	        //Calculate starting inccost[0,0] values
	        for (j=basevals[i]; j<currvals[i]; j++){
	          StatCostFunc(i, j);
	          k += StatCost;
	        }
	        
	        inccost[i] = [(currvals[i]-basevals[i]),k];
	        CalculateChange(i);
	      }
	      
	    }
	    TPEChanged();
	    
	    
	  });
	  
  
  function removeTask(){
      if ( $( "#task0" ).length ) {
        $("#task" + (counter - 1)).remove();
        counter = counter - 1;
      }
      TPEChanged()
    }
    
  function createTask(taskName, taskURL, taskTPE){
      if(taskName == null){
        taskName = "";
      } else {}
      if(taskURL == null){
        taskURL = "";
      } else {}
      if(taskTPE == null){
        taskTPE = "";
      } else {}
  
      $("#pointtaskcontainer").append('<div class="card bg-dark mb-1 mt-1" id="task'+ counter +'">'+
      '<div class="card-body p-2">'+
      '<div class="input-group mb-1 w-auto">'+
      '<input type="text" class="form-control rounded-0" placeholder="Task Name" id="taskname'+ counter +'" value="' + taskName +'">'+
      '<div class="input-group-append w-25">'+
      '<input type="text" class="form-control rounded-0" placeholder="TPE" onchange="TPEChanged()" id="tasktpe'+ counter +'" value="' + taskTPE +'">'+
      '</div>'+
      '</div>'+
      '<input type="text" class="form-control rounded-0" placeholder="Task URL" id="taskurl'+ counter +'" value="' + taskURL +'">'+
      '</div>'+
      '</div>');
      counter++;

    }
    
  function TPEChanged() {
    //alert("The text has been changed.");
    var avTPE = 0;
    var bankedpoints = (<?php echo $tpe; ?> - <?php echo $ape; ?>);
    
    var spentpoints = 0;
    
    for (i=0;i<12;i++){
      spentpoints+= inccost[i][1];
    }
    //alert(spentpoints);
    for (i=0;i<counter;i++){
      avTPE += parseInt(document.getElementById("tasktpe" +i).value);
      //alert(avTPE);
    }
    document.getElementById("availablepoints").innerHTML = avTPE + bankedpoints - spentpoints;
    document.getElementById("totalpoints").innerHTML = (<?php echo $tpe; ?> + avTPE);
    document.getElementById("appliedpoints").innerHTML = (<?php echo $ape; ?> + spentpoints);
    SaveControl();
  }

  function SaveControl(){
    if (parseInt(document.getElementById("availablepoints").innerHTML)<0){
      $('#updateBtn').prop('disabled', true);
      $('#availablepoints').addClass("text-danger");
    } else if (parseInt(document.getElementById("availablepoints").innerHTML)>=0){
      $('#updateBtn').prop('disabled', false);
      $('#availablepoints').removeClass("text-danger");
    }
  
  }


  var StatCost = 1;
  function StatCostFunc(stat, statval){
    
    if(statval < 40){
      StatCost = 1;
      return;
    } else if(statval < 50){
      StatCost = 2;
      return;
    } else if(statval < 70){
      StatCost = 3;
      return;
    } else if(statval < 75){
      StatCost = 5;
      return;
    } else if(statval < 80){
      StatCost = 6;
      return;
    } else if(statval < 85){
      StatCost = 8;
      return;
    } else if(statval < 90){
      StatCost = 12;
      return;
    } else if(statval <95){
      StatCost = 15;
      return;
    } else if(statval <100){
      StatCost = 18;
      return;
    } else {
      window.alert("...Well this is awkward...");
    }  
  }

  
  function IncreaseAttribute(stat){
      var archboost = false;
      if(<?php echo $archetype; ?> == 1){ //Engineer
          if (stat == 0 || stat == 3 || stat == 4){ archboost = true; }
      } else if (<?php echo $archetype; ?> == 2) {
          if (stat == 1 || stat == 2 || stat == 5 || stat == 6){ archboost = true; }
      }
	    if(currvals[stat] == 99 || (currvals[stat] == 90 && archboost == false)){
	        window.alert("You cannot increase your points further in this attribute..");
	      } else {
	        StatCostFunc(stat, currvals[stat]);
	        if((Number($('#availablepoints').text()) - StatCost) >= 0){
	          currvals[stat]++;
	          $('#value-' + stat).val(currvals[stat]);
	          inccost[stat][0]++;
	          inccost[stat][1] += StatCost;
	          document.getElementById("minusBtn-"+stat).classList.remove("disabled");
	          $('#minusBtn-'+stat).prop('disabled', null);
	          CalculateChange(stat);
		      TPEChanged();
	        } else {
	          window.alert("You don't have enough available points for that, the next upgrade requires " + StatCost + " points.");
	        }
	      }
  }
  
  function DecreaseAttribute(stat){
	    if(currvals[stat] > basevals[stat]){
	        currvals[stat]--;
	        $('#value-' + stat).val(currvals[stat]);
	        StatCostFunc(stat, currvals[stat]);
	        inccost[stat][0]--;
	        inccost[stat][1] -= StatCost;
	        if(currvals[stat] == basevals[stat]){
	          document.getElementById("minusBtn-"+stat).classList.add("disabled");
	          $('#minusBtn-'+stat).prop('disabled', true);
	        }
	        CalculateChange(stat);
	        TPEChanged();
	      }
  }
  
  function CalculateChange(stat){
	    if(currvals[stat] == basevals[stat]){
	      $('#chng-'+stat).val("");
	    } else {
	      $('#chng-'+stat).val("+"+inccost[stat][0] + " (" + inccost[stat][1] + " TPE)");
	    }   
	  }

var modified = 0;
  function SaveUpdate() {

  var counter = 0;
  var updates = {
      driverID: <?php echo $ID ?>,
      userID: <?php echo $userID ?>,
      tpe:  document.getElementById("totalpoints").innerHTML,
      ape:  document.getElementById("appliedpoints").innerHTML,
      aero: document.getElementById("value-0").value,
      agg:  document.getElementById("value-1").value,
      cha:  document.getElementById("value-2").value,
      con:  document.getElementById("value-3").value,
      eng:  document.getElementById("value-4").value,
      fin:  document.getElementById("value-5").value,
      qua:  document.getElementById("value-6").value,
      rdc:  document.getElementById("value-7").value,
      sht:  document.getElementById("value-8").value,
      sdy:  document.getElementById("value-9").value,
      ssy:  document.getElementById("value-10").value,
      o_tpe: "<?php echo $tpe; ?>",
      o_ape: "<?php echo $ape; ?>",
      o_aero:"<?php echo $aero; ?>",
      o_agg: "<?php echo $agg; ?>",
      o_cha: "<?php echo $cha; ?>",
      o_con: "<?php echo $con; ?>",
      o_eng: "<?php echo $eng; ?>",
      o_fin: "<?php echo $fin; ?>",
      o_qua: "<?php echo $qua; ?>",
      o_rdc: "<?php echo $rdc; ?>",
      o_sht: "<?php echo $sht; ?>",
      o_sdy: "<?php echo $sdy; ?>",
      o_ssy: "<?php echo $ssy; ?>"
  };

	
  while (document.getElementById("task" + counter)){
    updates["task"    + counter] = document.getElementById("taskname" + counter ).value;
    updates["taskTPE" + counter] = document.getElementById("tasktpe"  + counter ).value;
    updates["taskURL" + counter] = document.getElementById("taskurl"  + counter ).value;
    counter++;
  }
  if (counter == 0 && document.getElementById("appliedpoints").innerHTML != <?php echo $ape; ?> ) {
    updates["task"    + counter] = "DummyTask";
    updates["taskTPE" + counter] = "";
    updates["taskURL" + counter] = "";
  }
  
  $.post(
      "web/actions/saveupdate.php",
      updates,

      function(response) {
          if (response != "") {
              $( "#content" ).html(response);
          }
          else {
              alert("Saved");
          }
      },
      "html"
  )
  .fail(function() {
    alert( "error" );
  })

}

</script>

<script>
  feather.replace()
  
  $(function () {
  $('[data-toggle="popover"]').popover()
})
</script>



