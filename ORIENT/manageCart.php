<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//For security reasons you'd probably want to use $_SESSION['ID'] instead of $_REQUEST['userid']...
if(isset($_REQUEST['method']) && isset($_REQUEST['userid']) && is_numeric($_REQUEST['userid'])){
	include('controller/cartController.php');
	$cc = new cartController();
	$method = strtolower($_REQUEST['method']);
	$userID = $_REQUEST['userid'];
	if(($method == 'add' || $method == 'remove') && isset($_REQUEST['courseid']) && is_numeric($_REQUEST['courseid'])){
		$courseID = $_REQUEST['courseid'];
		if($method == 'add'){
			$cc->add($userID, $courseID);
		}elseif($method == 'remove'){
			$cc->remove($userID, $courseID);
		}
	}elseif($method == "list"){
		$cc->list($userID);
	}else{
		http_response_code(400);
	}
}else{
	http_response_code(400);
}
?>
