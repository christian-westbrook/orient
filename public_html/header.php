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

<div id="header">
	<?php
		if($sessionStarted == true)
		{
			echo '<a href="index.php"><p id="home-link">ORIENT</p></a>';
			echo '<a href="profile.php"><p>Profile</p></a>';
			echo '<a href="settings.php"><p>Settings</p></a>';
			echo '<form action="results.php" method="POST"><input type="text" name = "search" placeholder="Search..." /><input type="submit" value="Search"></form>';
			echo '<a href="php/logout-script.php" id="log-out"><p>Logout</p></a>';
		}
		else
		{
			echo '<a href="index.php"><p id="home-link">ORIENT</p></a>';
			echo '<input type="text" placeholder="Search..." />';
			echo '<a href="results.php"><p>Search</p></a>';
			echo '<a href="signup.php" id="sign-up"><p>Sign Up</p></a>';
			echo '<a href="auth.php" id="log-in"><p>Log In</p></a>';
		}
	?>
</div>
