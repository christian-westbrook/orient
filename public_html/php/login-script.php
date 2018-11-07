<?php

	include '../session.php';

	// Get the user information provided through POST
	$email      = $_POST['email'];
	$plaintext  = $_POST['password'];

	include 'database.php';

	$sql  = 'SELECT USER_ID, PASSWORD, ROLE_ID FROM USERS WHERE EMAIL= :EMAIL';

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);

	if($stmt->execute())
	{
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($results && password_verify($plaintext, $results[0]['PASSWORD']))
		{
			$info['USER_ID'] 	= $results[0]['USER_ID'];
			$info['ROLE_ID']	= $results[0]['ROLE_ID'];
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
