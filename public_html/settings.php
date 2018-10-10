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
 
// If the session hasn't started, then the user hasn't been authenticated and
// the system will redirect to the landing page.
if($sessionStarted == false)
{
	header('Location: /~iot3/');
}
 ?>
 
 <!-- These styles need to be moved into a separate css file. -->
<style>
.contain {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 90vh;
}

.myForm 
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 0.8em;
	width: 30em;
	padding: 1em;
	border: 1px solid #ccc;
	margin: auto;
}

.myForm * 
{
	box-sizing: border-box;
}

.myForm fieldset 
{
	border: none;
	padding: 0;
}

.myForm legend,
.myForm label 
{
	padding: 0;
	font-weight: bold;
}

.myForm label.choice 
{
	font-size: 0.9em;
	font-weight: normal;
}

.myForm label 
{
	text-align: left;
	display: block;
}

.myForm input[type="text"],
.myForm input[type="password"],
.myForm select,
.myForm textarea 
{
	float: right;
	width: 60%;
	border: 1px solid #ccc;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 0.9em;
	padding: 0.3em;
}

.myForm input[type="file"] 
{
	float: right;
	width: 60%;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 0.9em;
	padding: 0.3em;
}

.myForm button 
{
	padding: 1em;
	border-radius: 0.5em;
	background: #eee;
	border: none;
	font-weight: bold;
	margin-left: 40%;
	margin-top: 1.8em;
}

.myForm button:hover 
{
	background: #ccc;
	cursor: pointer;
}
</style>

</head>
<body>
	<div class="contain">
		<form class="myForm" method="get">

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

		</form>
	</div>

</body>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>