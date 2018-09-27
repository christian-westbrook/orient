<?php

/************************************************
 * System	: Schedu.IO
 * Version	: 1.0
 * File		: ./home.php
 * Developers	: Nicholas Leonard, Anthony Osagwu, and Christian Westbrook
 * Date Created : 9/19/18
 * Last Updated : 9/24/18
 * Abstract	:
 ************************************************/
// Utilize the Set Session
session_start();
if(!isset($_SESSION["logIn"]) && empty($_SESSION["logIn"]) ) {
	header("Location: index.php"); // Redirect to Login Page if Session is not set
}
// Include the Schedu.IO header
include('view/header.php');
?>

<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/home-styles.css" />
</head>

<body>
<div class="container">
	<div class="row justify-content-center">
		<form class="col-9" action="results.php" method="post">
			<h1 class="display-4 text-center">Search</h1>
			<div class="input-group input-group-lg">
				<input class="form-control" type="text" name="search" placeholder="Search by course name or number, department name, or instructor"/>
				<div class="input-group-append"><button class="btn btn-success" type="submit"><span class="oi oi-magnifying-glass"></span></button>
			</div>
		</form>
	</div>
</div>
</body>
</html>
