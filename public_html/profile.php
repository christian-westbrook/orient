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

// Retrieve the given user's info
include 'php/database.php';

$sql = "SELECT USERS.FNAME, USERS.LNAME, USERS.TITLE, DEPARTMENTS.NAME, USERS.EMAIL, USERS.PHONE_NUM, USERS.BIO, USERS.PROFILE, USERS.HOMETOWN FROM USERS INNER JOIN DEPARTMENTS ON USERS.DEP_ID = DEPARTMENTS.DEP_ID WHERE USERS.USER_ID= :ID"];

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
		$profile	= $results[0]['PROFILE'];
	}
}
else
{
	echo "Unable to find that user.";
}

?>

<div id="container">
	<div id="profile">

	</div>
</div>

</body>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
