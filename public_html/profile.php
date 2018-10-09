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

// Grab data from the USERS table
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

// Grab data from the USERS_UNIVERSITIES table
$sql = "SELECT UNIVERSITIES.NAME FROM UNIVERSITIES INNER JOIN USERS_UNIVERSITIES ON UNIVERSITIES.UNIV_ID = USERS_UNIVERSITIES.UNIV_ID WHERE USERS_UNIVERSITIES.USER_ID=" . $_SESSION['ID'];
$stmt = $pdo->query($sql);

if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$universities;
	
	$length = count($results);
	for($i = 0; $i < $length; $i++)
	{
		$universities[$i] = $results[$i]['NAME'];
	}
		
	$_POST['UNIVERSITIES'] = $universities;
}

// Grab data from the USERS_EMPLOYERS table

$sql = "SELECT EMPLOYERS.NAME FROM EMPLOYERS INNER JOIN USERS_EMPLOYERS ON EMPLOYERS.EMP_ID = USERS_EMPLOYERS.EMP_ID WHERE USERS_EMPLOYERS.USER_ID=" . $_SESSION['ID'];
$stmt = $pdo->query($sql);

if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$employers;
	
	$length = count($results);
	for($i = 0; $i < $length; $i++)
	{
		$employers[$i] = $results[$i]['NAME'];
	}
		
	$_POST['EMPLOYERS'] = $employers;
}

// Grab data from the USERS_SKILLS table

$sql = "SELECT SKILLS.NAME FROM SKILLS INNER JOIN USERS_SKILLS ON SKILLS.SKILL_ID = USERS_SKILLS.SKILL_ID WHERE USERS_SKILLS.USER_ID=" . $_SESSION['ID'];
$stmt = $pdo->query($sql);

if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$skills;
	
	$length = count($results);
	for($i = 0; $i < $length; $i++)
	{
		$skills[$i] = $results[$i]['NAME'];
	}
		
	$_POST['SKILLS'] = $skills;
}

// Grab data from the USERS_INTERESTS table

$sql = "SELECT INTERESTS.NAME FROM INTERESTS INNER JOIN USERS_INTERESTS ON INTERESTS.INT_ID = USERS_INTERESTS.INT_ID WHERE USERS_INTERESTS.USER_ID=" . $_SESSION['ID'];
$stmt = $pdo->query($sql);

if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$interests;
	
	$length = count($results);
	for($i = 0; $i < $length; $i++)
	{
		$interests[$i] = $results[$i]['NAME'];
	}
		
	$_POST['INTERESTS'] = $interests;
}

?>
 
<!-- These styles need to be moved into a separate css file. -->
<style>

.editButton 
{
	display: flex;
	align-items: center;
	justify-content: center;
	margin: auto;
	padding: 10px;
}

.dataContainerOne 
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 1.0em;
	width: 85%;
	height: 400px;
	padding: 1em;
	border: 1px solid #ccc;
	margin: auto;
}

.dataContainerTwo 
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 1.0em;
	width: 85%;
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
    left: 450px;
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
			<h5>Bio</h5>
			<p><?php echo $_POST['BIO']; ?></p>
			<h5>Skills</h5>
			<p>
			<?php
				$skills = $_POST['SKILLS'];
					
				$length = count($skills);
				for($i = 0; $i < $length; $i++)
				{
					echo $skills[$i] . " ";
				}
			?>
			</p>
			<h5>Research Interests</h5>
			<p>
			<?php
				$interests = $_POST['INTERESTS'];
					
				$length = count($interests);
				for($i = 0; $i < $length; $i++)
				{
					echo $interests[$i] . " ";
				}
			?>
			</p>
		</div>
		
	</div>
	
	<div class="dataContainerTwo">
		<div class="left">
			<h3>Hometown</h3>
			<br>
			<h3>Email</h3>
			<br>
			<h3>Phone Number</h3>
			<br>
			<h3>Universities</h3>
			<br>
			<h3>Employers</h3>
		</div>
		
		<div class="right">
			<h3><?php echo $_POST['HOMETOWN']; ?></h3>
			<br>
			<h3><?php echo $_POST['EMAIL']; ?></h3>
			<br>
			<h3><?php echo $_POST['PHONE_NUM']; ?></h3>
			<br>
			<h3>
				<?php
					$universities = $_POST['UNIVERSITIES'];
					
					$length = count($universities);
	
					for($i = 0; $i < $length; $i++)
					{
						echo $universities[$i] . "<br>";
					}
				?>
			</h3>
			<br>
			<h3>
				<?php
					$employers = $_POST['EMPLOYERS'];
					
					$length = count($employers);
	
					for($i = 0; $i < $length; $i++)
					{
						echo $employers[$i] . "<br>";
					}
				?>
			</h3>
		</div>
	<div>
</div>

<button onclick="window.location = 'settings.html'" class="editButton">Edit Profile</button>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
