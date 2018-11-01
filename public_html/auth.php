<?php

$css = array(
		0 => 'auth'
	    );
			
include 'header.php';

?>

<div id="container">
	<div id="auth">
		<p id="label">ORIENT</p>
		
		<form action="php/login-script.php" method="post">
			<input type="text" name="email" placeholder="Email" class="field" /></br>
			<input type="password" name="password" placeholder="Password" class="field" /><br>
			<input type="submit" value="Log In" id="sub-button">
		</form>
		
		<a href="signup.php"><p class="sub">Need to create an account?</p></a>
		<a href=""><p class="sub">Forgotton password?</p></a>
	</div>
</div>

<?php include 'footer.php'; ?>