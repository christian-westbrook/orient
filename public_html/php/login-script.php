<?php

	include '../session.php';

	// Get the user information provided through POST
	$email      = $_POST['email'];
	$plaintext  = $_POST['password'];


	// Encrypt the provided plaintext password
	$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);


	include 'database.php';

	$sql  = 'SELECT USER_ID FROM USERS WHERE EMAIL= :EMAIL AND PASSWORD= :PASSWORD';

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
	$stmt->bindParam(':PASSWORD', $plaintext, PDO::PARAM_STR);

	if($stmt->execute())
	{
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($results)
		{
			$info['USER_ID'] = $results[0]['USER_ID'];
			createSession($info);
			header( "Location: ../profile.php" );
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
