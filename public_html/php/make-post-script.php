<?php
	include '../session.php';

	$userid = $_SESSION['USER_ID'];
	$post = $_POST['post-field'];

	echo $post;

	include 'database.php';
	$sql = 'INSERT INTO POSTS (USER_ID, MESSAGE) VALUES (:USER_ID, :MESSAGE)';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':USER_ID', $userid, PDO::PARAM_INT);
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
