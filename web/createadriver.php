<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
?>

<script>

var sponsors = [[0,"None"],
<?php
  $sql="SELECT sponsorID, name FROM core_Sponsors;";
  $result = $link->query($sql);
  while (($spnsr = $result->fetch_array(MYSQLI_NUM)) != NULL) {
      echo "[";
      for ($i=0; $i < count($spnsr); $i++){
        if ($i == 1){
          echo "'".$spnsr[$i]."',";
        } else {
          echo $spnsr[$i] . ",";
        }
      }
      echo "], ";
    }
?>
];

var drivernumbers = [
  <?php 
  $sql="SELECT drivernumber FROM core_Drivers;";
  $result = $link->query($sql);
  while (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
   echo $row[0] . ", ";
  }
  ?>
  
  ];

</script>

<!-- Style sets the content width
       required for columned pages. -->
  <style>
    #content {
      max-width: 1000px !important;
    }
  </style>


<div id="content" class="container">
    
  <h1>Create a Driver</h1>
  <div class="alert alert-warning" role="alert">
    We don't have a record of you having a driver, please enter your driver details below to begin your racing career.
  </div>
  <div class="row">
    <div class="col-lg-6 pb-2">
      <div class="card">
        <img class="card-img-top" src="https://www.nascar.media/wp-content/uploads/sites/7/2017/01/Silhouette.png" alt="Driver Image" style="max-width:80%;">
        <div id="sponsors" style="width: 120px; height: 200px; position: absolute; right: 10px; top: 10px;">
            <img id="spnsrimg1" class="card-img-top" src="https://preview.cutcaster.com/801153017-1822857347.jpg" alt="sponsor1" style="width: 100%; height: 50%; padding-bottom: 10px;">
            <img id="spnsrimg2" class="card-img-top" src="https://preview.cutcaster.com/801153017-1822857347.jpg" alt="sponsor2" style="width: 100%; height: 50%; padding-bottom: 10px;">
        </div>
        
        <hr>
        <div class="card-body">
          <h5 class="card-title">Driver Details</h5>
          <!--Driver Details Begin -->
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <span class="input-group-text w-100" id="basic-addon1">First Name</span>
            </div>
            <input type="text" class="form-control" id="firstname" placeholder="...">
          </div>
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <span class="input-group-text w-100" id="basic-addon1">Last Name</span>
            </div>
            <input type="text" class="form-control" id="lastname" placeholder="...">
          </div>
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <label class="input-group-text w-100" for="numberDD">Number</label>
              <button type="button" class="btn btn-sm btn-info" data-container="body" data-trigger="focus" title="Driver Numbers" data-toggle="popover" data-placement="bottom" data-html="true" data-content="Select the number you want for your driver, this number will feature prominently on your car. Only available numbers will be displayed.">
                <i data-feather="help-circle"></i>
              </button>
            </div>
            <select class="custom-select" id="numberDD">
              <option selected>Choose...</option>
              <!-- Programatically Add in Options -->
            </select>
          </div>
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <span class="input-group-text w-100" id="basic-addon1">Hometown</span>
            </div>
            <input type="text" class="form-control" id="hometown" placeholder="...">
          </div>
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <label class="input-group-text w-100" for="archetypeDD">Archetype</label>
              <button type="button" class="btn btn-sm btn-info" data-container="body" data-trigger="focus" title="Archetypes" data-toggle="popover" data-placement="bottom" data-html="true" data-content="Select the archetype you want for your driver.<br><b>Engineer:</b> Will allow your driver to go over 90 in Aerodynamics, Consistency and Engine.<br><b>Wheelman:</b> Will allow your driver to go over 90 in Aggression, Chassis, Qualifying and Finishing.">
                <i data-feather="help-circle"></i>
              </button>
            </div>
            <select class="custom-select" id="archetypeDD">
              <option selected>Choose...</option>
              <option value="1">Engineer</option>
              <option value="2">Wheelman</option>
            </select>
          </div>
          <!--Sponsors Begin-->
          <h5 class="card-title pt-3">Sponsors
          </h5>
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <label class="input-group-text w-100" for="1SponsorDD">1st Sponsor</label>
              <button type="button" class="btn btn-sm btn-info" data-container="body" data-trigger="focus" title="Sponsors" data-toggle="popover" data-placement="bottom" data-content="Your primary sponsor will take pride of place on your cars livery, if you would prefer a different sponsor that is not listed, please contact an admin.">
                <i data-feather="help-circle"></i>
              </button>
            </div>
            <select class="custom-select" id="1SponsorDD" onchange="SponsorChanged(1)">
              <option selected>Choose...</option>
              <!-- Programatically Add in Options -->
            </select>
          </div>
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <label class="input-group-text w-100" for="2SponsorDD">2nd Sponsor</label>
              <button type="button" class="btn btn-sm btn-info" data-container="body" data-trigger="focus" title="Sponsors" data-toggle="popover" data-placement="bottom" data-content="Your secondary sponsor will be featured in your livery, if you would prefer a different sponsor that is not listed, please contact an admin.">
                <i data-feather="help-circle"></i>
              </button>
            </div>
            <select class="custom-select" id="2SponsorDD" onchange="SponsorChanged(2)">
              <option selected>Choose...</option>
              <!-- Programatically Add in Options -->
            </select>
          </div>
          <h5 class="card-title pt-3">Career Path</h5>
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <label class="input-group-text w-100" for="careerpathDD">Career Path</label>
            </div>
            <select class="custom-select" id="careerpathDD" disabled>
              <option value="1" selected>Stock Car</option>
              <option value="2" class="disabled">Open Wheel</option>
            </select>
          </div>
          
        
        </div> <!-- End of Card-Body -->
      </div> <!-- End of Card -->
      
      
      
    </div>
    <!--End of Column 1-->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Apply Your Initial Points</h5>
          <hr>
          <div class="alert alert-info" role="alert">
            You have 45 points to apply to your driver in the attributes below, you must apply all 45 before your can submit your driver.
          </div>
          <p class="card-text text-dark">You have <span class="badge badge-dark p-1" id="remainingTPE" style="font-size: 0.75rem;">45 TPE</span> to spend on your new player.
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
        
        </p>
        
        
       
          
          
          
          
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('AERO')" id="minusBtn-AERO">-</button>
            <input type="text" class="form-control text-center" disabled id="value-AERO" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('AERO')" id="plusBtn-AERO">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('AGG')" id="minusBtn-AGG">-</button>
            <input type="text" class="form-control text-center" disabled id="value-AGG" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('AGG')" id="plusBtn-AGG">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('CHA')" id="minusBtn-CHA">-</button>
            <input type="text" class="form-control text-center" disabled id="value-CHA" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('CHA')" id="plusBtn-CHA">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('CON')" id="minusBtn-CON">-</button>
            <input type="text" class="form-control text-center" disabled id="value-CON" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('CON')" id="plusBtn-CON">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('ENG')" id="minusBtn-ENG">-</button>
            <input type="text" class="form-control text-center" disabled id="value-ENG" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('ENG')" id="plusBtn-ENG">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('FIN')" id="minusBtn-FIN">-</button>
            <input type="text" class="form-control text-center" disabled id="value-FIN" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('FIN')" id="plusBtn-FIN">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('QUA')" id="minusBtn-QUA">-</button>
            <input type="text" class="form-control text-center" disabled id="value-QUA" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('QUA')" id="plusBtn-QUA">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('RDC')" id="minusBtn-RDC">-</button>
            <input type="text" class="form-control text-center" disabled id="value-RDC" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('RDC')" id="plusBtn-RDC">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('SHT')" id="minusBtn-SHT">-</button>
            <input type="text" class="form-control text-center" disabled id="value-SHT" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('SHT')" id="plusBtn-SHT">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('SDY')" id="minusBtn-SDY">-</button>
            <input type="text" class="form-control text-center" disabled id="value-SDY" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('SDY')" id="plusBtn-SDY">+</button>
          
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
          
            <button type="button" class="btn btn-primary rounded-0 disabled" style="width:38px;" onclick="DecreaseAttribute('SSY')" id="minusBtn-SSY">-</button>
            <input type="text" class="form-control text-center" disabled id="value-SSY" value="25">
            <button type="button" class="btn btn-primary rounded-0" style="width:38px;" onclick="IncreaseAttribute('SSY')" id="plusBtn-SSY">+</button>
          
          </div>
          
          <button type="button" class="btn btn-primary btn-block mt-3 disabled" id="createBtn" onclick="CreateDriver()">Create Driver!</button>
          
          
          
          
        </div> <!-- End of Card Body -->
      </div> <!-- End of Card -->
  
    </div>
    <!--End of Column 2-->
  </div>
</div>



<script>

$( document ).ready(function() {
    feather.replace();
    PopulateDropdowns();
});
  
  
$(function () {
  $('[data-toggle="popover"]').popover()
})

$('.popover-dismiss').popover({
  trigger: 'focus'
})


function AttrCostFunc(attrValue){
    
    if(attrValue < 40){
      return 1;
    } else if(attrValue < 50){
      return 2;
    } else if(attrValue < 70){
      return 3;
    } else if(attrValue < 75){
      return 5;
    } else if(attrValue < 80){
      return 6;
    } else if(attrValue < 85){
      return 8;
    } else if(attrValue < 90){
      return 12;
    } else if(attrValue < 95){
      return 15;
    } else if(attrValue <100){
      return 18;
    } else {
      window.alert("...Well this is awkward...");
    }  
  }
var currentTPE = 45;

function IncreaseAttribute(attribute) {

  var attrValue;
  var tpeValue;
  
  attrValue = parseInt(document.getElementById("value-" + attribute).value, 10);
  if(parseInt(document.getElementById("remainingTPE").innerHTML, 10) < AttrCostFunc(attrValue)) {
  alert("Insufficient TPE available.");
  } else {
  
  attrValue += 1;
  document.getElementById("value-" + attribute).value = attrValue;
  document.getElementById("minusBtn-" + attribute).classList.remove('disabled');
  
  
  currentTPE -= AttrCostFunc(attrValue-1);
  document.getElementById("remainingTPE").innerHTML= currentTPE + " TPE";
  if (currentTPE == 0){
    document.getElementById("createBtn").classList.remove('disabled')
  }
  }
  
}

function DecreaseAttribute(attribute) {
  var attrValue;
  var tpeValue;
  
  attrValue = parseInt(document.getElementById("value-" + attribute).value, 10);
  attrValue -= 1;
  
  if (attrValue >= 25) {
    document.getElementById("value-" + attribute).value = attrValue;
    
   
    currentTPE += AttrCostFunc(attrValue);
    document.getElementById("remainingTPE").innerHTML= currentTPE + " TPE";
  } 
  
  if (attrValue == 25){
    document.getElementById("minusBtn-" + attribute).classList.add('disabled');
  }
  if (currentTPE > 0){
    document.getElementById("createBtn").classList.add('disabled');
  }
   
}

function PopulateDropdowns(){
    for (i=0; i<sponsors.length; i++){
        document.getElementById("1SponsorDD").innerHTML +=
        "<option value=" + i + ">" + sponsors[i][1] + "</option>";
        document.getElementById("2SponsorDD").innerHTML +=
        "<option value=" + i + ">" + sponsors[i][1] + "</option>";
    }
    for (i=0; i<100;i++){
      if (drivernumbers.length > 0){
        for (j=0; j<drivernumbers.length;j++){
          if(i == drivernumbers[j]){
            break;
          } else {
            document.getElementById("numberDD").innerHTML +=
            "<option value=" + i + ">" + i + "</option>";
          }
        }
      } else {
          document.getElementById("numberDD").innerHTML +=
            "<option value=" + i + ">" + i + "</option>";
      }
    }
    
}

function SponsorChanged(sponsornum){
    idx = document.getElementById(sponsornum + "SponsorDD").value;
    document.getElementById("spnsrimg" + sponsornum).src = "img/sponsors/logo_sm/" + sponsors[idx][0] + ".png";
    
}

function CreateDriver(){
  var firstname = document.getElementById("firstname").value;
  var lastname = document.getElementById("lastname").value;
  var prefnumber = document.getElementById("numberDD").value;
  var hometown = document.getElementById("hometown").value;
  var archetype = document.getElementById("archetypeDD").value;
  var sponsor1 = document.getElementById("1SponsorDD").value;
  var sponsor2 = document.getElementById("2SponsorDD").value;
  var careerpath = document.getElementById("careerpathDD").value;
  
  if (currentTPE > 0){
    //Button Disabled!
  } else if (firstname.length == 0){
    alert("Please enter a first name.");
  } else if (lastname.length == 0){
    alert("Please enter a last name.");  
  } else if (prefnumber.length == 0){
    alert("Please enter a number between 0 and 999.");  
  } else if (hometown.length == 0){
    alert("Please enter a hometown.");  
  } else if (isNaN(archetype)){
    alert("Please select an archetype.");  
  } else if (isNaN(sponsor1)){
    alert("Please select a primary sponsor.");  
  } else if (isNaN(sponsor2)){
    alert("Please select a secondary sponsor.");   
  } else if (isNaN(careerpath)){
    alert("Please select a career path.");   
  } else {
    //Post  
    $.post( "web/actions/createdriver.php", 
    { 
      userid: <?php echo $_SESSION['userID'];?>,
      firstname: firstname,
      lastname:  lastname,
      prefnumber: prefnumber,
      hometown:  hometown,
      archetype: archetype,
      sponsor1: sponsor1,
      sponsor2: sponsor2,
      careerpath: careerpath,
      AERO: document.getElementById("value-AERO").value,
      AGG: document.getElementById("value-AGG").value,
      CHA: document.getElementById("value-CHA").value,
      CON: document.getElementById("value-CON").value,
      ENG: document.getElementById("value-ENG").value,
      FIN: document.getElementById("value-FIN").value,
      QUA: document.getElementById("value-QUA").value,
      RDC: document.getElementById("value-RDC").value,
      SHT: document.getElementById("value-SHT").value,
      SDY: document.getElementById("value-SDY").value,
      SSY: document.getElementById("value-SSY").value,
    }, 
    function() {
      //alert( "success" );
    })
    .done(function() {
      //alert( "second success" );
      loadcontent('/web/yourdriver.php', '#id-yourdriver', '')
    })
    .fail(function() {
      alert( "error" );
    })
  }
  
  
} //End of Create Driver Function




</script>