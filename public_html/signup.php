<?php

$css = array(
		0 => 'signup'
	    );
			
include 'header.php';

?>

<div id="container">
	<div id="auth">
		<p id="label">ORIENT</p>
		
		<form>
			<input type="text" name="email" placeholder="Email" class="field" /></br>
			<input type="password" name="password" placeholder="Password" class="field" /></br>
			<input type="password" name="confirm" placeholder="Confirm" class="field" /></br>
			<input type="submit" value="Sign Up" id="sub-button">
		</form>
		
		<a href="auth.php"><p class="sub">Already have an account?</p></a>
	</div>
</div>

<?php include 'footer.php'; ?>