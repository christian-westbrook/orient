<?php
session_start();
function checkSession(){
	return isset($_SESSION['ID']) ? true : false;
}
function createSession($info){
	$_SESSION['ID'] = $info['USER_ID'];
	$_SESSION['EMAIL'] = $info['EMAIL'];
	$_SESSION['USERNAME'] = $info['USERNAME'];
	$_SESSION['FNAME'] = $info['FNAME'];
	$_SESSION['LNAME'] = $info['LNAME'];
}
function closeSession(){
	if(checkSession()){
		session_destroy();
		return true;
	}else{
		return false;
	}
}
$sessionStarted = checkSession();
?>
