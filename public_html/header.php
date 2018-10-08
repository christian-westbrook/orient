<?php

/**************************************************************************
 * System	  : Optimized Research Interest Network
 * Version	  : Prototype System I
 * File		  : header.php
 * Developers : Christian Westbrook, Nicholas Leonard
 *
 * Abstract	  : 
 **************************************************************************/

// This code tells PHP to display all error messages to the screen.
// This code is only for development purposes and should be removed before
// deploying.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initiates the session.
include('session.php');

?>

<!DOCTYPE html>
<html lang="en" style="height: 100%" class="bg-light">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
		
		<?php
		if(isset($css))
		{
		  foreach ($css as $file) 
		  {
		    echo "<link rel='stylesheet' href='css/$file.css'>";
		  }
		}
		?>
		
		<title>ORIENT<?php echo (isset($title) ? " - $title" : ''); ?></title>
	</head>
	
  	<body style="min-height: 100%;">
    	<nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
			<div class="container-fluid">
				<div class="navbar-brand">
					<a href="index.php"><img class="d-inline-block align-top" src="img/uafs-white.png" height="30"/></a>
				</div>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
        		<div class="collapse navbar-collapse" id="navbarNav">
        			<ul class="navbar-nav">
						<li class="nav-item"><a class="text-white nav-link" href="home.php">Home<a/></li>
						
						<?php
						if($sessionStarted == true){
							echo "<li class='nav-item'><a class='text-white nav-link' href='cart.php'>Cart</a></li>";
							echo "<li class='nav-item'><span class='text-white navbar-text'>Welcome, ".$_SESSION['USERNAME']."!</span></li>";
							echo "<li class='nav-item'><a class='text-white nav-link' href='signout.php'>Sign Out</a></li>";
						}
						?>
			
					</ul>
        		</div>
			</div>
		</nav>