<?php

/*****************************************************************************
 * System	: Schedu.IO
 * Version	: 1.0
 * File		: ./view/header.php
 * Developers	: Nicholas Leonard, Anthony Osagwu, and Christian Westbrook
 * Date Created : 9/19/18
 * Last Updated : 9/23/18
 * Abstract	:
 *****************************************************************************/

// Configures PHP to report any error that occurs
error_reporting(E_ALL);
// Configures PHP to send reported errors to the page as output.
// TODO REMOVE THIS LINE BEFORE DEPLOYING! THIS LINE IS ONLY INTENDED FOR THE DEV ENVIRONMENT!
ini_set('display_errors', 1);
?>

<!doctype html>
<html lang="en" style="height: 100%" class="bg-light">
	<head>
    		<meta charset="utf-8">
    		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    		<link rel="stylesheet" href="css/bootstrap.min.css">
    		<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    		<title>Schedu.IO</title>
  	</head>

  	<body style="min-height: 100%;">

    	<!-- Navigation Bar -->
    	<nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
		<div class="container">

			<!-- UAFS Logo -->
			<div class="navbar-brand">
				<a href="index.php"><img class="d-inline-block align-top" src="img/uafs-white.png" height="30"/></a>
			</div>


			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

        		<div class="collapse navbar-collapse" id="navbarNav">
        			<ul class="navbar-nav">
        			</ul>
        		</div>
		</div>
	</nav>
