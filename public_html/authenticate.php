<?php

$css = array(
				0 => 'authenticate'
			);
			
include 'header.php';

?>

<div id="container">
	<div id="auth">
		<p>Log In</p>
		
		<form>
			<input type="text" name="email" placeholder="Email" /></br>
			<input type="password" name="password" placeholder="Password" /><br>
		</form>
	</div>
</div>

<?php include 'footer.php'; ?>