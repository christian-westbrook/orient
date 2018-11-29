<?php
	if(!isset($_POST['submit']))
	{
		echo "error! you need to submit the form!";
	}
	$email = $_POST['email'];
	include 'php/database.php';
	$sql  = 'SELECT * USERS WHERE EMAIL= :EMAIL';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR)
	if($stmt->execute())
	{
		if($stmt->rowCount()>0)
		{
			$subject = "Password reset request";
			$headers = "From: admin@orient.com";
			$body = "blah"
			mail($email,$subject,$body,$headers);
			header('Location: auth.php');
		}
		else
		{
			header( "Location: ../auth.php" );
		}
	}
	else
	{
		echo "Unable to access the ORIENT database.";
	}
?>
