<?php

$css = array(
				0 => 'explore'
			);

include 'header.php';

// Time formatter function
function formatDateTime($datetime)
{
	$year = substr($datetime, 0, 4);
	$month = substr($datetime, 5, 2);
	$day = substr($datetime, 8, 2);
	$time = substr($datetime, 11, 8);

	switch ($month)
	{
		case "01": 	$month = 'Jan.';
		 			break;
		case "02": $month = 'Feb.';
					break;
		case "03": $month = 'Mar.';
					break;
		case "04": $month = 'Apr.';
					break;
		case "05":	$month = 'May';
					break;
		case "06":	$month = 'June';
					break;
		case "07": 	$month = 'July';
					break;
		case "08":	$month = "Aug.";
					break;
		case "09":	$month = "Sep.";
					break;
		case "10":	$month = "Oct.";
					break;
		case "11":	$month = "Nov.";
					break;
		case "12":	$month = "Dec.";
					break;
	}

	$formatted = $month . ' ' . $day . ', ' . $year . ' ' . $time;
	return $formatted;
}

?>

<body>
	<div id="container">
	<?php

	include 'php/database.php';
	$sql = "SELECT USERS.USER_ID, USERS.TITLE, USERS.FNAME, USERS.LNAME, USERS.PROFILE, POSTS.MESSAGE, POSTS.CREATE_TIME FROM POSTS INNER JOIN USERS ON USERS.USER_ID = POSTS.USER_ID";
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
				$post = $results[$key]["MESSAGE"];
				$datetime = $results[$key]["CREATE_TIME"];
				$time = formatDateTime($datetime);
				echo '<div class="post"><img class="post-profile-pic" src="' . $profile . '" /> <span class="post-name">' . $name . '</span></br><span class="post-message">' . $post . '</span></br><span class="post-time">' . $time . '</span></div></br></br>';
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
