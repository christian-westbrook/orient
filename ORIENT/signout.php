<?php
include_once('controller/session.php');
if(closeSession()){
	header('Location: /~iot3/');
}else{
	echo "Hmmmmm";
}
?>
