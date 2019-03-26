<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
  
  $sql = "SELECT sponsorID, name FROM core_Sponsors;";
  $result = $link->query($sql);
  while (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
    //LogFile("newfile.txt", "Sponsor " . $row[1]);
    $sponsors[$row[0]] = $row[1];
  }
  
?>


<script>
document.title = "All Drivers | SCOR.Manager";
var tabledata = [
<?php
  $sql = "SELECT core_Drivers.userID, core_Users.displayname, core_Drivers.firstname, core_Drivers.lastname, core_Drivers.drivernumber, " .
                "core_Drivers.hometown, core_Drivers.archetype, core_Drivers.sponsor1, core_Drivers.sponsor2, core_Drivers.careerpath, " .
                "core_Drivers.TPE, core_Drivers.APE, core_Drivers.AERO, core_Drivers.AGG, core_Drivers.CHA, core_Drivers.CON, " . 
                "core_Drivers.ENG, core_Drivers.FIN, core_Drivers.QUA, core_Drivers.RDC, core_Drivers.SHT, core_Drivers.SDY, core_Drivers.SSY, core_Drivers.uniqueID FROM core_Drivers " . 
                "INNER JOIN core_Users ON core_Drivers.userID = core_Users.userID";
  $result = $link->query($sql);
  while (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
    $primary = $sponsors[$row[7]];
    $secondary = $sponsors[$row[8]];
        
    //LogFile("newfile.txt", "Driver " . $row[3]);
    echo "{id:" . $row[0] . ", name:\"" . $row[2] . " " . $row[3] . "\", user:\"" . $row[1] . "\", number:" . $row[4] . ", sp1:\"" . $primary . "\", sp2:\"" . $secondary . 
         "\", tpe:" . $row[10] . ", ape:" . $row[11] . ", aero:" . $row[12] .", agg:" . $row[13] . ", cha:" . $row[14] . ", con:" . $row[15] . ", eng:" . $row[16] . 
         ", fin:" . $row[17] . ", qua:" . $row[18] . ", rdc:" . $row[19] . ", sht:" . $row[20] . ", sdy:" . $row[21] . ", ssy:" . $row[22] . ", uid:" . $row[23] . "},";
    }
?>

];

</script>


<div style="width: 90vw;" id="example-table"></div>


<script>
 //create Tabulator on DOM element with id "example-table"
var table = new Tabulator("#example-table", {
 	height:"80vh", // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
 	data:tabledata, //assign data to table
 	layout:"fitDataFill", //fit columns to width of table (optional)
 	columns:[ //Define Table Columns
	 	{title:"Name", field:"name", width:150},
	 	{title:"User", field:"user", width:100},
	 	{title:"No.", field:"number"},
	 	{title:"Sponsor 1", field:"sp1"},
	 	{title:"Sponsor 2", field:"sp2"},
	 	{title:"TPE", field:"tpe"},
	 	{title:"APE", field:"ape"},
	 	{title:"AERO", field:"aero"},
	 	{title:"AGG", field:"agg"},
	 	{title:"CHA", field:"cha"},
	 	{title:"CON", field:"con"},
	 	{title:"ENG", field:"eng"},
	 	{title:"FIN", field:"fin"},
	 	{title:"QUA", field:"qua"},
	 	{title:"RDC", field:"rdc"},
	 	{title:"SHT", field:"sht"},
	 	{title:"SDY", field:"sdy"},
	 	{title:"SSY", field:"ssy"},
	 	{title:"uid", field:"uid", visible:false},
 	],
 	rowClick:function(e, row){ //trigger an alert message when the row is clicked
 		loadcontent('/web/yourdriver.php', '', row.getData().uid);
 	},
});
</script>