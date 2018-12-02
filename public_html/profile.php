<?php
/**************************************************************************
 * System		: Open-source Research Interest Network
 * Version		: Final System
 * File			: profile.php
 * Developers	: Brad Hamilton, Christian Westbrook
 *
 * Abstract 	:
 **************************************************************************/

$css = array(
				0 => 'profile'
	    	);

include 'header.php';

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

// Retrieve the given user's info
include 'php/database.php';

$sql = "SELECT FNAME, LNAME, TITLE, EMAIL, PHONE_NUM, BIO, PROFILE, HOMETOWN, DEP_ID, ROLE_ID, UNIV_ID, EMP_ID FROM USERS WHERE USER_ID= :ID";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $id, PDO::PARAM_INT);

if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if($results)
	{
		$_POST['NAME'] = $results[0]['TITLE'] . " " . $results[0]['FNAME'] . " " . $results[0]['LNAME'];
		$_POST['EMAIL'] = $results[0]['EMAIL'];
		$_POST['PHONE_NUM'] = $results[0]['PHONE_NUM'];
		$_POST['BIO'] = $results[0]['BIO'];
		$_POST['PROFILE'] = $results[0]['PROFILE'];
		$_POST['HOMETOWN'] = $results[0]['HOMETOWN'];
		$_POST['DEP_ID'] = $results[0]['DEP_ID'];
		$_POST['ROLE_ID'] = $results[0]['ROLE_ID'];
		$_POST['UNIV_ID'] = $results[0]['UNIV_ID'];
		$_POST['EMP_ID'] = $results[0]['EMP_ID'];
	}
}
else
{
	echo "Unable to find that user.";
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

// Get the name of the users' department
$sql = "SELECT NAME FROM DEPARTMENTS WHERE DEP_ID = :DEP_ID";
$stmt = $conn->prepare($sql);
$dep_id = (int) $_POST['DEP_ID'];
$stmt->bindParam(':DEP_ID', $dep_id, PDO::PARAM_INT);

$dep = '';
if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$dep = $results[0]['NAME'];
}

$_POST['DEP'] = $dep;

// Get the name of the users' role
$sql = "SELECT NAME FROM ROLES WHERE ROLE_ID = :ROLE_ID";
$stmt = $conn->prepare($sql);
$role_id = (int) $_POST['ROLE_ID'];
$stmt->bindParam(':ROLE_ID', $role_id, PDO::PARAM_INT);

$role = '';
if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$role = $results[0]['NAME'];
}

$_POST['ROLE'] = $role;

// Get the name of the users' university
$sql = "SELECT NAME FROM UNIVERSITIES WHERE UNIV_ID = :UNIV_ID";
$stmt = $conn->prepare($sql);
$univ_id = (int) $_POST['UNIV_ID'];
$stmt->bindParam(':UNIV_ID', $univ_id, PDO::PARAM_INT);

$univ = '';
if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$univ = $results[0]['NAME'];
}

$_POST['UNIV'] = $univ;

// Get the name of the users' employer
$sql = "SELECT NAME FROM EMPLOYERS WHERE EMP_ID = :EMP_ID";
$stmt = $conn->prepare($sql);
$emp_id = (int) $_POST['EMP_ID'];
$stmt->bindParam(':EMP_ID', $emp_id, PDO::PARAM_INT);

$emp = '';
if($stmt->execute())
{
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$emp = $results[0]['NAME'];
}

$_POST['EMP'] = $emp;

?>

<div id="container">
		<img id="profile-pic" src="<?php echo $_POST['PROFILE']; ?>">

		<div id="head-info">
			<h1><?php echo $_POST['NAME']; ?></h1>
			<p><?php echo $_POST['ROLE']; ?></br> <?php echo $_POST['UNIV']; ?></br> <?php echo $_POST['DEP']; ?></br><?php echo $_POST['EMP']; ?></p>
			<p><b>Research Summary</b></br></br>
		   	   <?php echo $_POST['BIO']; ?></p>
			   <p><b>Email:</b> <?php echo $_POST['EMAIL']; ?></p>
   			<p><b>Phone:</b> <?php echo $_POST['PHONE_NUM']; ?></p>
			<p><b>Hometown:</b> <?php echo $_POST['HOMETOWN']; ?></p>
		</div>

	<div id="ints-skills">
		<p><b>Research Interests</b></br></br>
		<?php
		   	$interests = $_POST['INTERESTS'];

		   	$length = count($interests);
		   	for($i = 0; $i < $length; $i++)
		   	{
			   echo '<a class="interest" href="results.php?SEARCH="' . $interests[$i] . '">' . $interests[$i] . '</a> ';
		   	}
	   	?></p>

		<p><b>Skills</b></br></br>
		<?php
		   	$skills = $_POST['SKILLS'];

		   	$length = count($skills);
		   	for($i = 0; $i < $length; $i++)
		   	{
			   echo '<a class="skill" href="results.php?SEARCH="' . $skills[$i] . '">' . $skills[$i] . '</a> ';
		   	}
	   	?></p>
   	</div>

	<?php
	if($id === $_SESSION['USER_ID'])
	{
		echo '	<form id="post-form" action="php/make-post-script.php" method="POST">
					<p><b>Make Post</b></p>
					<input type="text" name="post" id="post-field" placeholder="How\'s your research going?" />
					<input type="submit" id="post-button" value="Post" />
				</form>';
	}
	?>
</div>

<!-- Defines the footer of each page -->
<?php include 'footer.php'; ?>
