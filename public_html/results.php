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

			echo "<p>" . $search . "</p>";

			$search = $_POST['search'];
			$search = "%$search%";

			$sql = 'SELECT USERS_INTERESTS.USER_ID FROM USERS_INTERESTS INNER JOIN INTERESTS ON USERS_INTERESTS.INT_ID = INTERESTS.INT_ID WHERE INTERESTS.NAME LIKE :SEARCH';
			$stmt->bindParam(':SEARCH', $search, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if($results)
				{
					echo "<p>" . $results[0]['USER_ID'] . "</p>";
				}
			}
		?>
	</div>
</div>

</body>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
