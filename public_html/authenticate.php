<?php

$css = array(
				0 => 'authenticate'
			);
			
include 'header.php';

?>

<div id="container">
	<div id="auth">
		<p id="label">Log In</p>
		
		<form>
			<input type="text" name="email" placeholder="Email" /></br>
			<input type="password" name="password" placeholder="Password" /><br>
		</form>
		
		<a href="signup.php"><p class="sub">Need to create an account?</p></a>
	</div>
</div>

<?php include 'footer.php'; ?>