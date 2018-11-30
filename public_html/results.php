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

			$sql = 'SELECT USERS.FNAME, USERS.LNAME FROM USERS LEFT JOIN USERS_INTERESTS ON USERS_INTERESTS.USER_ID = USERS.USER_ID INNER JOIN INTERESTS ON INTERESTS.INT_ID = USERS_INTERESTS.INT_ID WHERE INTERESTS.NAME LIKE :SEARCH';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':SEARCH', $search, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if($results)
				{
					foreach($results as $key => $value)
					{
						echo $results[$key]['FNAME'] . " " . $results[$key]['LNAME'] . "<br>";
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
