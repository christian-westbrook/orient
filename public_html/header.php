<head>
	<title>ORIENT</title>
	<link rel="stylesheet" type="text/css" href="css/header.css" />
	
	<?php
	
	// Generates links for css stylesheets
	foreach($css as $sheet)
	{
		echo '<link rel="stylesheet" type="text/css" href="css/' . $sheet . '" />';
	}
	?>
	
	<meta charset="utf-8">
</head>

<div id="header">
	<a href="index.php"><p>ORIENT</p></a>
	<a href="profile.php"><p>Profile</p></a>
	<a href="settings.php"><p>Settings</p></a>
	<input type="text" placeholder="Search..." />
	<a href="authenticate.php" id="log-in"><p>Log In</p></a>
</div>