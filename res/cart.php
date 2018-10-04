<?php
$title = "My Schedule";
include('view/header.php');
if($sessionStarted == false){
	header('Location: /~iot3/');
}
include('controller/cartController.php');
$cc = new cartController();
$cc->list($_SESSION['ID']);
?>
<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-lg-9 col-md-12 border border-seconday rounded bg-light shadow-sm mx-2">
      <?php
      //echo "<pre>";
      //var_dump(['Introduction to Programming'=>['date'=>'MWF', 'startTime'=>'08:15 AM', 'endTime'=>'09:30 AM']]);
      //echo "</pre>";?>
      <h3 class="text-center mb-0">My Schedule</h3>
      <hr class="my-1">
      <?php generateTable(); ?>
    </div>
    <div class="col-lg col-md-12 border border-seconday rounded bg-light shadow-sm mx-2">
      <h3 class="text-center mb-0">Order Info</h3>
      <hr class="my-1">
      <ul>
        <li>CS#### - Intro to Programming 1
          <ul>
            <li>CRN: ###</li>
            <li>Date: MWF</li>
            <li>Time: 08:00 AM - 09:15 AM</li>
            <li>Instructor: Andrew Mackey</li>
            <li>Location: Baldor 147</li>
          </ul>
        </li>
        <li>CS#### - Intro to Networking 1
          <ul>
            <li>CRN: ###</li>
            <li>Date: TW</li>
            <li>Time: 09:30 AM - 10:45 AM</li>
            <li>Instructor: Brian Henahan</li>
            <li>Location: Baldor 145B</li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<?php include('view/footer.php'); ?>
<?php
function generateTable(){
  $current = "08:00 AM";
  $start = "08:00 AM";
  $end = "08:00 PM";
  echo '<table class="table table-sm table-bordered text-center">';
  echo '<thead><tr><th width="16.6%">&nbsp;</th><th width="16.6%">Monday</th><th width="16.6%">Tuesday</th><th width="16.6%">Wednesday</th><th width="16.6%">Thursday</th><th width="16.6%">Friday</th></tr></thead>';
  echo '<tbody>';
  while($current != $end){
    $current = date('h:i A', strtotime('+15 minutes', strtotime($current)));
    echo '<tr><th>'.$current.'</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
  }
  echo '</tbody>';
  echo '</table>';
}
?>
