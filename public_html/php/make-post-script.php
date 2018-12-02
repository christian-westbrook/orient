<?php
	include '../session.php';

	$post = $_POST['post'];

	include 'database.php';
	$sql = 'INSERT INTO POSTS (USER_ID, MESSAGE) VALUES (:USER_ID, :MESSAGE)';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $_SESSION['USER_ID'], PDO::PARAM_INT);
	$stmt->bindParam(':MESSAGE', $post, PDO::PARAM_INT);

	if($stmt->execute())
	{
		header( "Location: ../profile.php" );
	}
	else
	{
		echo "Unable to create post";
	}
?>
