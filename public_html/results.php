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

			echo $search;

			$sql = 'SELECT USERS.FNAME, USERS.LNAME, INTERESTS.NAME FROM USERS INNER JOIN USERS_INTERESTS ON USERS_INTERESTS.USER_ID = USERS.USER_ID INNER JOIN INTERESTS ON INTERESTS.INT_ID = USERS_INTERESTS.INT_ID WHERE INTERESTS.NAME LIKE :SEARCH';
			$stmt->bindParam(':SEARCH', $search, PDO::PARAM_STR);
			echo 'HERE';

			if($stmt->execute())
			{
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if($results)
				{
					print_r($results);
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
