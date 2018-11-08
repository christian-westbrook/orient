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

include('header.php');

 ?>

<div id="container">
	<div id="results">
		<?php
			include 'php/database.php';

			$search = "%" . $_POST['search'] . "%";

			$sql = 'SELECT USERS_INTERESTS.USER_ID, USERS_INTERESTS.INT_ID, INTERESTS.NAME FROM USERS_INTERESTS INNER JOIN INTERESTS ON USERS_INTERESTS.INT_ID = INTERESTS.INT_ID WHERE INTERESTS.NAME LIKE "A"';
			//$stmt->bindParam(':SEARCH', $search, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if($results)
				{
					print_r($results);
				}
			}
		?>
	</div>
</div>

</body>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
