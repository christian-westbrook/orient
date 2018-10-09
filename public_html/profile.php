<?php

/**************************************************************************
 * System	  : Optimized Research Interest Network
 * Version	  : Prototype System I
 * File		  : profile.php
 * Developers : Anthony Todaro, Christian Westbrook
 *
 * Abstract	  : 
 **************************************************************************/
 
// Includes the header. This file needs to be tested and adapted for ORIENT.
include('header.php');
 
// If the session hasn't started, then the user hasn't been authenticated and
// the system will redirect to the landing page.
if($sessionStarted == false)
{
	header('Location: /~iot3/');
}

// There are no user entries here, so no prepared statements are necessary.
include('database.php');
$sql = "SELECT FNAME, LNAME, TITLE, DEP_ID, EMAIL, PHONE_NUM FROM USERS";
$stmt = $pdo->query($sql);

if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else
{
	echo "FAIL";
}

$_POST['NAME'] = $results[0]['FNAME'] . " " . $results[0]['LNAME'];
?>
 
<!-- These styles need to be moved into a separate css file. -->
<style>

.dataContainerOne 
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 1.0em;
	width: 75%;
	padding: 1em;
	border: 1px solid #ccc;
	margin: auto;
}

.dataContainerTwo 
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 1.0em;
	width: 75%;
	height: 400px;
	padding: 1em;
	border: 1px solid #ccc;
	margin: auto;
}

.profilePicture 
{
	width:250px;
	height:250px;
}

.userDesc 
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 0.8em;
	padding: 1em;
	position: absolute;
    top: 80px;
    left: 650px;
    width: 250px;
    height: 100px;
}

.userDesc h2 
{
	margin: auto;
	text-align: center;
}

.dataContainerTwo h3 
{
	span: 50%;
	margin: auto;
	text-align: center;
}

.dataContainerTwo .left 
{
	width: 50%;
	float: left;
}

.dataContainerTwo .right 
{
	width: 50%;
	float: right;
}

</style>

<div>

	<div class="dataContainerOne">

		<img class="profilePicture" src="picture.jpg">

		<div class="userDesc">
			<h1><?php echo $_POST['NAME']; ?></h1>
			<h1>Computer Science</h1>
		</div>
		
	</div>
	
	<div class="dataContainerTwo">
		<div class="left">
			<h3>First Name</h3>
			<br>
			<h3>Last Name</h3>
			<br>
			<h3>Title</h3>
			<br>
			<h3>Department</h3>
			<br>
			<h3>Email</h3>
			<br>
			<h3>Phone Number</h3>
		</div>
		
		<div class="right">
			<h3>Anthony</h3>
			<br>
			<h3>Todaro</h3>
			<br>
			<h3>Computer Scientist</h3>
			<br>
			<h3>Computer Science</h3>
			<br>
			<h3>rtodar00@g.uafs.edu</h3>
			<br>
			<h3>479-651-0987</h3>
		</div>
		
	<div>

</div>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>