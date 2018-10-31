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
			Username</br>
			<input type="text" name="username" /></br>
			Password
			<input type="password" name="password" /><br>
		</form>
	</div>
</div>

<?php include 'footer.php'; ?>