<?php
/**************************************************************************
 * System	: Open-source Research Interest Network
 * Version	: Prototype System II
 * File		: profile.php
 * Developers 	: Christian Westbrook
 *
 * Abstract 	:
 **************************************************************************/

$css = array(
				0 => 'profile'
	    	);

include('header.php');

if($sessionStarted == false)
{
   $id = $_GET['SEARCH_ID'];
}

// Get the ID of the user to display
if(isset($_GET['SEARCH_ID']))
{
	$id = $_GET['SEARCH_ID'];
}
else
{
	$id = $_SESSION['USER_ID'];
}

$id = $_SESSION['USER_ID'];

// Retrieve the given user's info
include 'php/database.php';

$sql = "SELECT USERS.FNAME, USERS.LNAME, USERS.TITLE, DEPARTMENTS.NAME, USERS.EMAIL, USERS.PHONE_NUM, USERS.BIO, USERS.PROFILE, USERS.HOMETOWN FROM USERS INNER JOIN DEPARTMENTS ON USERS.DEP_ID = DEPARTMENTS.DEP_ID WHERE USERS.USER_ID= :ID";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $id, PDO::PARAM_STR);

if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if($results)
	{
		$fname 		= $results[0]['FNAME'];
		$lname 		= $results[0]['LNAME'];
		$title		= $results[0]['TITLE'];
		$dep		= $results[0]['NAME'];
		$email		= $results[0]['EMAIL'];
		$phone_num	= $results[0]['PHONE_NUM'];
		$bio		= $results[0]['BIO'];
		$hometown	= $results[0]['HOMETOWN'];
	}
}
else
{
	echo "Unable to find that user.";
}

// Grab data from the USERS_UNIVERSITIES table
$sql = "SELECT UNIVERSITIES.NAME FROM UNIVERSITIES INNER JOIN USERS_UNIVERSITIES ON UNIVERSITIES.UNIV_ID = USERS_UNIVERSITIES.UNIV_ID WHERE USERS_UNIVERSITIES.USER_ID= :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $id, PDO::PARAM_STR);
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
$sql = "SELECT EMPLOYERS.NAME FROM EMPLOYERS INNER JOIN USERS_EMPLOYERS ON EMPLOYERS.EMP_ID = USERS_EMPLOYERS.EMP_ID WHERE USERS_EMPLOYERS.USER_ID= :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $id, PDO::PARAM_STR);
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
$sql = "SELECT SKILLS.NAME FROM SKILLS INNER JOIN USERS_SKILLS ON SKILLS.SKILL_ID = USERS_SKILLS.SKILL_ID WHERE USERS_SKILLS.USER_ID= :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $id, PDO::PARAM_STR);
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
$sql = "SELECT INTERESTS.NAME FROM INTERESTS INNER JOIN USERS_INTERESTS ON INTERESTS.INT_ID = USERS_INTERESTS.INT_ID WHERE USERS_INTERESTS.USER_ID= :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $id, PDO::PARAM_STR);
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

<div id="container">
	<div id="profile">

		<div id="dataContainerOne">

		<img id="profilePicture" src="<?php echo $_POST['PROFILE']; ?>">

		<div id="userDesc">
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

	<div id="dataContainerTwo">
		<div id="left">
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

		<div id="right">
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
</div>

</body>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
