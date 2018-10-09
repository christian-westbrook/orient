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
// Select all of the relevant profile information and load it into the $_POST associative array.
include('database.php');
$sql = "SELECT USERS.FNAME, USERS.LNAME, USERS.TITLE, DEPARTMENTS.NAME, USERS.EMAIL, USERS.PHONE_NUM, USERS.BIO, USERS.PROFILE, USERS.HOMETOWN FROM USERS INNER JOIN DEPARTMENTS ON USERS.DEP_ID = DEPARTMENTS.DEP_ID WHERE USERS.USER_ID=" . $_SESSION['ID'];
$stmt = $pdo->query($sql);

if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$_POST['NAME'] = $results[0]['TITLE'] . " " . $results[0]['FNAME'] . " " . $results[0]['LNAME'];
	$_POST['DEP'] = $results[0]['NAME'];
	$_POST['EMAIL'] = $results[0]['EMAIL'];
	$_POST['PHONE_NUM'] = $results[0]['PHONE_NUM'];
	$_POST['BIO'] = $results[0]['BIO'];
	$_POST['PROFILE'] = $results[0]['PROFILE'];
	$_POST['HOMETOWN'] = $results[0]['HOMETOWN'];
}
else
{
	echo "FAIL";
}
?>
 
<!-- These styles need to be moved into a separate css file. -->
<style>

.dataContainerOne 
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 1.0em;
	width: 75%;
	padding: 1em;
	padding-top: 3em;
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
    <!-- width: 250px; -->
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

		<img class="profilePicture" src="<?php echo $_POST['PROFILE']; ?>">

		<div class="userDesc">
			<h1><?php echo $_POST['NAME']; ?></h1>
			<h1><?php echo $_POST['DEP']; ?></h1>
			<br>
			<p><?php echo $_POST['BIO']; ?></p>
		</div>
		
	</div>
	
	<div class="dataContainerTwo">
		<div class="left">
			<h3>Hometown</h3>
			<br>
			<h3>Email</h3>
			<br>
			<h3>Phone Number</h3>
		</div>
		
		<div class="right">
			<h3><?php echo $_POST['HOMETOWN']; ?></h3>
			<br>
			<h3><?php echo $_POST['EMAIL']; ?></h3>
			<br>
			<h3><?php echo $_POST['PHONE_NUM']; ?></h3>
		</div>
	<div>
</div>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>