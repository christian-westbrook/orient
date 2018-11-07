<?php
include '../session.php';

if($_POST['password'] == $_POST['confirm'])
{
	// do something with the request
  	//are we making the user automatically i.e. sql insert statement
  	//are we sending email to admins to confirm before doing sql insert
  	//in either case, there has to somehow be a dept_id (this could be used as a means to confirm or not)

	// Get the user information provided through POST
  	$email 		= $_POST['email'];
  	$plaintext 	= $_POST['password'];
	$fname		= $_POST['fname'];
	$lname		= $_POST['lname'];

	$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);

  	include 'database.php';

	$sql  = 'INSERT INTO USERS (EMAIL, PASSWORD, FNAME, LNAME, CREATE_TIME) VALUES (:EMAIL, :PASSWORD, :FNAME, :LNAME, NOW())';

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
	$stmt->bindParam(':PASSWORD', $ciphertext, PDO::PARAM_STR);
	$stmt->bindParam(':FNAME', $fname, PDO::PARAM_STR);
	$stmt->bindParam(':LNAME', $lname, PDO::PARAM_STR);

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
