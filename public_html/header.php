<?php

include 'session.php';
?>

<head>
	<title>ORIENT</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/header.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css" />
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

	<?php

	// Generates css links
	foreach($css as $key => $value)
	{
		echo '<link rel="stylesheet" type="text/css" href="css/' . $value . '.css" />';
	}

	// Generates js links
	foreach($js as $key => $value)
	{
		echo '<script src="js/' . $value . '.js"></script>';
	}

	?>
</head>

<script language="javascript" type="text/javascript">

	window.onload = function()
	{
		var a = document.getElementById("search-link");
		a.onclick = function search()
		{

			var searchString = document.getElementById("input").value;
			var redirect = "results.php?SEARCH=" + searchString;
			window.location.href = redirect;
		}
		
		function enter(e)
		{
			
			if( e.keyCode == 13 || e.which == 13 ) 
			{
				
				var searchString = document.getElementById("input").value;
				var redirect = "results.php?SEARCH=" + searchString;
				window.location.href = redirect;
				
			}
			
		}
		
	}
</script>

<div id="header">
	<?php
		if($sessionStarted == true)
		{
			echo '<a href="index.php"><p id="home-link">ORIENT</p></a>';
			echo '<a href="profile.php"><p>Profile</p></a>';
			echo '<a href="settings.php"><p>Settings</p></a>';
			echo '<a href="explore.php"><p id="explore-link">Explore</p></a>';
			if($_SESSION['ROLE_ID'] == 5)echo '<a href="admin-settings.php"><p>Admin</p></a>';
			echo '<input type="text" id="input" placeholder="Search..." />';
			echo '<a onclick="search()" onkeypress="enter(event)" href="#" id="search-link"><p>Search</p></a>';
			echo '<a href="php/logout-script.php" id="log-out"><p>Logout</p></a>';
		}
		else
		{
			echo '<a href="index.php"><p id="home-link">ORIENT</p></a>';
			echo '<a href="explore.php"><p id="explore-link">Explore</p></a>';
			echo '<input type="text" id="input" placeholder="Search..." />';
			echo '<a onclick="search()" href="#" id="search-link"><p>Search</p></a>';
			echo '<a href="signup.php" id="sign-up"><p>Sign Up</p></a>';
			echo '<a href="auth.php" id="log-in"><p>Log In</p></a>';
		}
	?>
</div>
