<?php
	try
	{
		$host =     'localhost';
		$username = 'orientdb';
		$password = 'UApass123';
		$dbname = 'orientdb';

		$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Connection falied: " . $e->getMessage();
	}
?>
