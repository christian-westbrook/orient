<?php

	// Get the user information provided through POST
	$email      = $_POST['email'];
	$plaintext  = $_POST['password'];
	

	// Encrypt the provided plaintext password
	$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);


	include 'database.php';

	$sql  = 'SELECT * FROM USERS WHERE EMAIL= :EMAIL AND PASSWORD= :PASSWORD';

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
	$stmt->bindParam(':PASSWORD', $plaintext, PDO::PARAM_STR);
	$stmt->execute()

	if($stmt->rowCount()>0)
	{
		session_start();
		$results = $stmt->fetchAll();
		$_SESSION['profArr'] = $results;
		header( "Location: ../profile.php" );
	}
	else
	{
		header("Location: ../auth.php");
	}
?>
