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
</head>
<body>
	<div class="contain">
		<form class="myForm" method="post" onsubmit="validatePass(this);">

			<p>
				<label>Password
				<input type="password" id="password" placeholder="Password">
				</label> 
			</p>

			<p>
				<label>Password 
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
			
			<script>
				function validatePass(theForm) {
					
					if(theForm.password.value == theForm.password_confirm.value) {
						
						alert('Passwords match!');
						
					} else {
						
						alert('Passwords don\'t match!');
						
					}
					
				}
			</script>

		</form>
	</div>

</body>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>