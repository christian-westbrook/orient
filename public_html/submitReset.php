<? php
	if(!isset($_POST['submit']))
	{
		echo "error; you need to submit the form!";
	}

	$email = $_POST['email'];
	$link = "espn.com";
	$subject = "Password reset request";
	$body = "Here is the link to reset your password.\n\n".$link;
	mail($email, $subject,$body);
	header('Location: ./auth.php');
?>
