<?php

$css = array(
		0 => 'auth'
	    );
			
include 'header.php';

?>

<div id="container">
	<div id="auth">
		<p id="label">ORIENT</p>
		
		<form action="#" method="post">
			<input type="text" name="email" placeholder="Email" class="field" /></br>
			<input type="submit" name="submit" value="Reset Password" id="sub-button">
		</form>
		
		<a href="auth.php"><p class="sub">Want to sign in?</p></a>
	</div>
</div>

<?php include 'footer.php'; ?>

<? php
	
	if(isset($_POST[submit])) {

		$email = $_POST['email'];
		$link = "espn.com";
		$body = "Here is the link to reset your password.";

		mail($email,$body,$link);
	}
?>