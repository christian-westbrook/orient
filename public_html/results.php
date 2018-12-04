<?php
/**************************************************************************
 * System	: Open-source Research Interest Network
 * Version	: Prototype System II
 * File		: results.php
 * Developers 	: Christian Westbrook
 *
 * Abstract 	:
 **************************************************************************/

$css = array(
		0 => 'results'
	    );

include 'header.php';

 ?>

<div id="container">
	<div id="results">
		<?php
			include 'php/database.php';

			$search = "%" . $_GET['SEARCH'] . "%";

			$sql = 'SELECT DISTINCT USERS.USER_ID, USERS.TITLE, USERS.FNAME, USERS.LNAME, USERS.PROFILE, USERS.BIO FROM USERS INNER JOIN USERS_INTERESTS ON USERS_INTERESTS.USER_ID = USERS.USER_ID INNER JOIN INTERESTS ON INTERESTS.INT_ID = USERS_INTERESTS.INT_ID INNER JOIN USERS_SKILLS ON USERS_SKILLS.USER_ID = USERS.USER_ID INNER JOIN SKILLS ON SKILLS.SKILL_ID = USERS_SKILLS.SKILL_ID WHERE INTERESTS.NAME LIKE :SEARCH OR SKILLS.NAME LIKE :SEARCH OR USERS.FNAME LIKE :SEARCH OR USERS.LNAME LIKE :SEARCH';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':SEARCH', $search, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if($results)
				{
					foreach($results as $key => $value)
					{
						$id = $results[$key]["USER_ID"];
						$name = $results[$key]["TITLE"] . ' ' . $results[$key]["FNAME"] . ' ' . $results[$key]["LNAME"];
						$profile = $results[$key]["PROFILE"];
						$bio = $results[$key]["BIO"];
						echo '<div class="result"><img class="result-pic" src="' . $profile . '" /><a href="profile.php?SEARCH_ID=' . $id . '"><p class="result-name">' . $name . '</p></a><p class="result-summary">' . $bio . '</p></div>';
					}
				}
			}
			else
			{

			}
		?>
	</div>
</div>

<!-- Defines the footer of each page -->
<?php include 'footer.php'; ?>
