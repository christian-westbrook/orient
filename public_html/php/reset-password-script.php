<?php
	$email = $_POST['email'];
  	$password = $_POST['password'];
  	$confirm = $_POST['confirm'];
  	$userid = (int)$_POST['userid'];
  	include 'database.php';
	$sql  = 'SELECT * FROM USERS WHERE USER_ID= :USER_ID AND EMAIL= :EMAIL';
  	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':USER_ID', $userid, PDO::PARAM_INT);
  	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
  if($stmt->execute())
	{
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($results && strcmp($password,$confirm))
		{
            		//$ciphertext = password_hash($password, PASSWORD_DEFAULT);
            		$sql = 'UPDATE USERS SET PASSWORD= :PASSWORD WHERE USER_ID= :USER_ID';
            		$stmt = $conn->prepare($sql);
            		$stmt->bindParam(':USER_ID', $userid, PDO::PARAM_INT);
			//$stmt->bindParam(':PASSWORD', $ciphertext, PDO::PARAM_STR);
            		$stmt->bindParam(':PASSWORD', $password, PDO::PARAM_STR);
            		if($stmt->execute())
        	  	{
                		header( "Location: ../settings.php" );
            		}
  		}
    	}
?>
