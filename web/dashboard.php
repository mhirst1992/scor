<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php'; 
?>

<script>
    document.title = "Dashboard | SCOR.Manager";
</script>


<div class="alert alert-info alert-sm" role="alert">
  Welcome to the SCOR Manager <b><?php echo $_SESSION['displayname']; ?></b>. If you have any issues please contact an admin, otherwise you can head to "Your Driver" to create your driver and get ready to race!
  <br>
  If you have any suggestions on things to add let Wally know!
</div>