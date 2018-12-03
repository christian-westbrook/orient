<?php
	include '../session.php';

	$userid = $_SESSION['USER_ID'];
	$post = $_POST['post-field'];

	echo $post;

	include 'database.php';
	$sql = 'INSERT INTO POSTS (USER_ID, MESSAGE) VALUES (:USER_ID, :POST)';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':USER_ID', $userid, PDO::PARAM_INT);
	$stmt->bindParam(':POST', $post, PDO::PARAM_STR);

	if($stmt->execute())
	{
		header( "Location: ../profile.php" );
	}
	else
	{
		echo "Unable to create post";
	}
?>
