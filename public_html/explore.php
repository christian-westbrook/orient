<?php

$css = array(
				0 => 'explore'
			);

include 'header.php';

?>

<body>
	<div id="container">
	<?php

	include 'php/database.php';
	$sql = "SELECT USERS.USER_ID, USERS.TITLE, USERS.FNAME, USERS.LNAME, USERS.PROFILE, POSTS.MESSAGE FROM POSTS INNER JOIN USERS ON USERS.USER_ID = POSTS.USER_ID";
	$stmt = $conn->prepare($sql);

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
				$post= $results[$key]["MESSAGE"];
				echo '<div class="post"><img class="post-pic" src="' . $profile . '" /><a href="profile.php?SEARCH_ID=' . $id . '"><p class="post-name">' . $name . '</p></a><p class="post-message">' . $post . '</p></div>';
			}
		}
	}
	else
	{

	}

	?>
	</div>
</body>
<?php include 'footer.php'; ?>
