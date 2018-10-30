<?php
/**************************************************************************
 * System	  : Optimized Research Interest Network
 * Version	  : Prototype System I
 * File		  : settings.php
 * Developers : Anthony Todaro, Christian Westbrook
 *
 * Abstract	  : This file presents the home page of the ORIENT web system.
 *              The page displays an authentication interface to the user,
 *              who can choose to register with the site or to log in with
 *              an existing account. Authentication provides access to
 *              ORIENT, a social network designed with researchers in mind.
 **************************************************************************/
 
// Includes the header. This file needs to be tested and adapted for ORIENT.
include('header.php');

 ?>
<head>
	<link rel="stylesheet" type="text/css" href="css/settings.css">
	<script type="text/javascript" src="js/validatePassword.js"></script>
</head>
<body>
	<div class="contain">
		<form class="myForm" method="post" id="settingsForm" onsubmit="validatePass(this);">

			<p>
				<label>Old Password
				<input type="password" id="old_password" placeholder="Old Password">
				</label> 
			</p>
		
			<p>
				<label>New Password
				<input type="password" id="password" placeholder="New Password">
				</label> 
			</p>

			<p>
				<label>New Password 
				<input type="password" id="password_confirm" placeholder="Confirm Password">
				</label>
			</p>

			<p>
				<label>Email 
				<input type="text" placeholder="Email">
				</label>
			</p>

			<p>
				<button id="Save_Btn">Save</button>
			</p>

		</form>
	</div>

</body>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>