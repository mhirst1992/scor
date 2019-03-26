<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
?>

<!-- Style sets the content width
       required for columned pages. -->
  <style>
    #content {
      max-width: 1000px !important;
    }
  </style>

<script>
document.title = "Admin Tasks | SCOR.Manager";

  var taskdata = [
      <?php
      $sql = "SELECT * FROM core_Tasks WHERE approved = 0";
      $result = $link->query($sql);
      while (($row = $result->fetch_array(MYSQLI_NUM)) != NULL) {
       echo "{id:".$row[0].", task:\"".$row[1]."\", userid:". $row[2] .", action:\"";
       if (stristr($row[1],"New Driver:")){
           echo "Open new Driver details.";
       } else if (stristr($row[1],"New Update:")){
           echo "Open new update details.";
       }
       echo "\"},";
      }
      
      ?>
 ];
    
</script>



<div class="row">
  <div class="card mb-3 mr-1">
    <div class="card-body">
      <h5 class="card-title">Admin Tasks</h5>
      <hr>
      <p>All tasks that must be completed before simming will apear in this list. 
         Click on the Action Cell to access information on the new Driver or an update. 
         Click the X to clear the task from your list.</p>
      
    </div>
  </div>
  
  <div id="task-table" style="width: 100%"></div>
</div>

<div class="modal fade" id="TaskModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalBody">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info d-none" onclick="" id="modifyBtn">Modify</button>
        <button type="button" class="btn btn-warning" onclick="" id="cleartask">Approve & Clear Task</button>
      </div>
    </div>
  </div>
</div>




<script>
var table = new Tabulator("#task-table", {
	data:taskdata,
	height:"60vh",
    layout: "fitDataFill",
    rowFormatter:function(row){
        //row - row component
        var data = row.getData();
        if(data.task.includes("New Driver: ")){
            row.getElement().style.backgroundColor = "#28a74580";
        }
        if(data.task.includes("New Update: ")){
            row.getElement().style.backgroundColor = "#287da780";
        }
    },
	columns:[                 //define the table columns
		{title:"Task", field:"task", width:"40%", headerFilter:true},
		{title:"UserID", field:"userid", visible:false},
		{title:"Action", field:"action", width:"60%", cellClick:function(e, cell){ExpandTask(cell)}},
	],
});


function ExpandTask(cell){
  if(cell.getRow().getData().task.includes("New Driver: ")){
	$.post(
      "web/actions/getDriver.php",
      { 
        userid: cell.getRow().getData().userid
      }, 
      function(response) {
        if (response != "") {
          //do our other stuff
          //console.log(response);
          $('#TaskModal').modal('toggle');
          $('#modalTitle').html(cell.getRow().getData().task);
          $('#modalBody').html(response);
          $('#modifyBtn').removeClass("d-block");
          $('#modifyBtn').addClass("d-none");
          celltoremove = cell;
          document.getElementById('cleartask').setAttribute( "onClick", "ClearTask(celltoremove)" );
        } else {
          console.log("Empty response from getDriver.php");
        }
      }
    ) //End of Post
    .done(function() {
      //nothing
    })
    .fail(function() {
      alert( "Unable to POST to web/actions/getDriver.php. Please contact an administrator." );
    })
  }
	
  if(cell.getRow().getData().task.includes("New Update: ")){
	$.post(
      "web/actions/getUpdate.php",
      { 
        userid: cell.getRow().getData().userid
      }, 
      function(response) {
        if (response != "") {
          //do our other stuff
          $('#TaskModal').modal('toggle');
          $('#modalTitle').html(cell.getRow().getData().task);
          $('#modalBody').html(response);
          $('#modifyBtn').removeClass("d-none");
          $('#modifyBtn').addClass("d-block");
          celltoremove = cell;
          document.getElementById('cleartask').setAttribute( "onClick", "ApproveUpdate(celltoremove)" );
          document.getElementById('modifyBtn').setAttribute( "onClick", "ModifyUpdate(celltoremove)" );
        } else {
          console.log("Empty response from getUpdate.php");
        }
      }
    ) //End of Post
    .done(function() {
      //nothing
    })
    .fail(function() {
      alert( "Unable to POST to web/actions/getUpdate.php. Please contact an administrator." );
    })
  }
}


function ClearTask(cell){
    cell.getRow().delete();
    $('#TaskModal').modal('toggle');
    //Post to DB to UPDATE core_Tasks SET approved = 1 WHERE ;
    task = cell.getRow().getData().id;
    TaskApproved(task);
}

function ModifyUpdate(cell){
    $('#TaskModal').modal('toggle');
    $('*').removeClass("modal-backdrop");
    $.post(
      "web/actions/getID.php",
      { 
        userid: cell.getRow().getData().userid
      }, 
      function(response) {
        if (response != "") {
        loadcontent("/web/driverupdate.php", "", response);
        }
      })
    
    //loadcontent
}

function ApproveUpdate(cell){
  $.post(
    "web/actions/approveUpdate.php",
    { 
      user: cell.getRow().getData().userid
    }
  )
    
    ClearTask(cell);
}

function TaskApproved(task){
  $.post(
    "web/actions/approveTask.php",
    { 
      task: task
    }
  )
}

    
</script>