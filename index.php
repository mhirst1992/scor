<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php'; 
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SCOR Manager</title>
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Tabulator core CSS -->
    <link href="https://unpkg.com/tabulator-tables@4.2.2/dist/css/tabulator.min.css" rel="stylesheet">
    
  </head>
  
  
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="http://scor.sportsball.pro">SCOR.MANAGER</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#SCORnavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="SCORnavbar">
        <ul class="navbar-nav mr-auto">
          <li id="id-dashboard" class="nav-item">
            <button class="nav-link" style="background-color:#343a40; border:none;" onclick="loadcontent('/web/dashboard.php', '#id-dashboard')">Dashboard</button>
          </li>
          <li id="id-yourdriver" class="nav-item">
            <button class="nav-link" style="background-color:#343a40; border:none;" onclick="loadcontent('/web/yourdriver.php', '#id-yourdriver', '')">Your Driver</button>
          </li>
          <li id="id-alldrivers" class="nav-item">
            <button class="nav-link" style="background-color:#343a40; border:none;" onclick="loadcontent('/web/alldrivers.php', '#id-alldrivers')">All Drivers</button>
          </li>
          <li id="id-administration" class="nav-item dropdown <?php if ($_SESSION['userID'] > 2 ){echo "d-none";}?>">
            <a class="nav-link dropdown-toggle" style="cursor:pointer;" id="admindropdown" data-toggle="dropdown">Administration</a>
            <div class="dropdown-menu  rounded-0 border-0"  style="background-color:#343a40; margin-top:8px; width:250px;" >
              <button class="nav-link w-100 text-left" style="background-color:#343a40; border:none;" onclick="loadcontent('/web/tasks.php', '#id-administration')">Tasks</button>
            </div>
          </li>
          <li id="id-signout" class="nav-item float-right">
            <button class="nav-link" style="background-color:#343a40; border:none;" onclick="loadcontent('/web/session/signout.php', '#id-signout')">Signout</button>
          </li>
        </ul>
      </div>
    </nav>

<div id="content" class="container m-1" style="padding-top:60px;">
  
    

</div><!-- END OF CONTENT -->




<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.2.2/dist/js/tabulator.min.js"></script>

<script>
$( document ).ready(function() {
  loadcontent('/web/dashboard.php', '#id-dashboard');
});



var oldlabel = "#id-dashboard";
  function loadcontent(page, label, param, param2 = 0) {
    if(param2 != 0){
      param2t = "&param2=" + param2;
    } else{
      param2t="";
    }
    $( "#content" ).html( "<br/><br/><br/>Loading data..." );
    $.get( page + "?param=" + param + param2t, function( data ) {
    //alert( "Load was performed.   " + data );
    $( "#content" ).html( data );
    $(oldlabel).removeClass('active');
    $(label).addClass('active');
    oldlabel = label;
    });};

$(function () {
  $('[data-toggle="popover"]').popover()
})

</script>

























</html>