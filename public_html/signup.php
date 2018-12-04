<?php

$css = array(
		0 => 'signup'
	    );

include 'header.php';

?>

<body>

	<div id="container">
		<div id="auth">
			<p id="label">ORIENT</p>

			<form action="php/signup-script.php" method="post">
				<input type="email" name="email" placeholder="Email" class="field" /></br>
				<input type="text" name="fname" placeholder="First Name" class="field" /></br>
				<input type="text" name="lname" placeholder="Last Name" class="field" /></br>
				<input type="password" name="password" placeholder="Password" class="field" /></br>
				<input type="password" name="confirm" placeholder="Confirm" class="field" /></br>
				<input type="submit" value="Sign Up" id="sub-button">
			</form>

			<a href="auth.php"><p class="sub">Already have an account?</p></a>
		</div>
	</div>

</body>
	
<?php include 'footer.php'; ?>
