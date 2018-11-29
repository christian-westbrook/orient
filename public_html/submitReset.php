<?php
	if(!isset($_POST['submit']))
	{
		echo "error! you need to submit the form!";
	}
	$email = $_POST['email'];
	include 'php/database.php';
	$sql  = 'SELECT * FROM USERS WHERE EMAIL= :EMAIL';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
	if($stmt->execute())
	{
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($results)
		{
			$subject = "Password reset request";
			$headers = "From: admin@orient.com";
			$body = "blah";
			mail($email,$subject,$body,$headers);
			header('Location: auth.php');
		}
		else
		{
			echo "you goofed.";
		}
	}
	else
	{
		echo "Unable to access the ORIENT database.";
	}
?>
