<?php
	try
	{
		$host =     'orientdb.c86myvnpmoub.us-east-2.rds.amazonaws.com';
		$username = 'cwestbrook';
		$password = 'orientdb';

		$conn = new PDO("mysql:host=$host;dbname=ORIENT", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Connection falied: " . $e->getMessage();
	}
?>
