<head>
	<title>ORIENT</title>
	<link rel="stylesheet" type="text/css" href="css/header.css" />
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	
	<?php
	
	// Generates links for css stylesheets
	foreach($css as $key => $value)
	{
		echo '<link rel="stylesheet" type="text/css" href="css/' . $value . '.css" />';
	}
	?>
	
	<meta charset="utf-8">
</head>

<div id="header">
	<a href="index.php"><p id="home-link">ORIENT</p></a>
	<a href="profile.php"><p>Profile</p></a>
	<a href="settings.php"><p>Settings</p></a>
	<input type="text" placeholder="Search..." />
	<a href="results.php"><p>Search</p></a>
	<a href="signup.php" id="sign-up"><p>Sign Up</p></a>
	<a href="authenticate.php" id="log-in"><p>Log In</p></a>
</div>