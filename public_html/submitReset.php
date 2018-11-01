<? php
	
	if(isset($_POST[submit])) {

		$email = $_POST['email'];
		$link = "espn.com";
		$body = "Here is the link to reset your password.";

		mail($email,$body,$link);
	}
?>