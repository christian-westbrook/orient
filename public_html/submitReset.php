<?php
	if(!isset($_POST['submit']))
	{
		echo "error! you need to submit the form!";
	}
	$email = $_POST['email'];
	$link = "espn.com";
	$subject = "Password reset request";
	$body = "Here is the link to reset your password.\n\n".$link;
	$headers = "From: overlords@orient.com";
	mail($email,$subject,$body,$headers);
	header('Location: auth.php');
?>
