<?php

	// Get the user information provided through POST
	$email      = $_POST['email'];
	$plaintext  = $_POST['password'];

	// Encrypt the provided plaintext password
	$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);


	include 'database.php';

	$sql  = 'SELECT * FROM USERS WHERE EMAIL=:EMAIL AND PASSWORD=:PASSWORD';

	$stmt = $conn->prepare($sql);
	$stmt->bind_param(':EMAIL', $email, PDO::PARAM_STR);
	$stmt->bind_param(':PASSWORD', $plaintext, PDO::PARAM_STR);

	if($stmt->execute())
	{
			$results = $fetchAll();
			print_r($results);
			$stmt->close();
	}
	else
	{
		echo "Statement failed to execute.";
	}
?>
