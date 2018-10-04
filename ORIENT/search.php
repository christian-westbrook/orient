<?php
if(isset($_REQUEST['s'])){
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  require_once('controller/searchController.php');
  $search = $_REQUEST['s'];
  $s = new searchController();
  $s->select2($search);
}else {
  http_response_code(400);
}
?>
