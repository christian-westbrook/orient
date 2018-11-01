<?php
	$email      = $_POST['email'];
	$plaintext  = $_POST['password'];

	$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);
	
	include 'database.php';
	$sql  = 'SELECT USER_ID FROM USERS WHERE EMAIL=":EMAIL" AND PASSWORD=":PASSWORD"';

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
	$stmt->bindParam(':PASSWORD', $plaintext, PDO::PARAM_STR);
	$stmt->execute();

	$results = $fetchAll();
	
	print_r($results);
?>