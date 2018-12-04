<?php

$css = array(
				0 => 'auth'
	    	);

include 'header.php';

?>

<body>

	<div id="container">
		<div id="auth">
			<p id="label">ORIENT</p>

			<form action="php/login-script.php" method="post">
				<input type="email" name="email" placeholder="Email" class="field" /></br>
				<input type="password" name="password" placeholder="Password" class="field" /><br>
				<input type="submit" value="Log In" id="sub-button">
			</form>

			<a href="signup.php"><p class="sub">Need to create an account?</p></a>
			<a href="forgotten.php"><p class="sub">Forgot your password?</p></a>
		</div>
	</div>

</body>
<?php include 'footer.php'; ?>
