<?php
include '../session.php';

if($_POST['password'] == $_POST['confirm'])
{

	// Get the user information provided through POST
  	$email 		= $_POST['email'];
  	$plaintext 	= $_POST['password'];
	$fname		= $_POST['fname'];
	$lname		= $_POST['lname'];
    $profile    = "img/users/default.png";

	$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);

  	include 'database.php';

	$sql  = 'INSERT INTO USERS (EMAIL, PASSWORD, FNAME, LNAME, CREATE_TIME, ROLE_ID, PROFILE) VALUES (:EMAIL, :PASSWORD, :FNAME, :LNAME, NOW(), 1, :PROFILE)';

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
	$stmt->bindParam(':PASSWORD', $ciphertext, PDO::PARAM_STR);
	$stmt->bindParam(':FNAME', $fname, PDO::PARAM_STR);
	$stmt->bindParam(':LNAME', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':PROFILE', $profile, PDO::PARAM_STR);

	if($stmt->execute())
	{
		header( "Location: ../auth.php" );
	}
	else
	{
		echo "Unable to create account";
	}
}
else
{
  echo "Password fields must match";
}
?>
