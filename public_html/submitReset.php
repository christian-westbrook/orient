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
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$body ='
				<!DOCTYPE html>
				<html>
				<head>
				<style>
				.button{
					background-color: white;
					color: black;
					font-size: 16px;
					border-radius: 12px;
					transition-duration: 0.4s;
					border: 2px solid #008CBA;
					
				}
				.button:hover {
					background-color: #008CBA;
					color: white;
				}
				</style>
				</head>
				<body>
					A request to reset your ORIENT password was recently submitted.<br>
					If you did not make this request then please ignore this message.<br>
					Otherwise, follow the link below to reset your password.<br><br>
					<form method="post" action="code.cis.uafs.edu/~orient/pwreset.php" class="inline">
					  <input type="hidden" name="email" value="'.$email.'">
					  <button class="button" type="sybmit">Reset Password</button>
					</form>
				</body>
				</html>
			';
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
