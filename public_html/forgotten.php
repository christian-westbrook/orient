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
			
			<form action="submitReset.php" method="post">
				<input type="email" name="email" placeholder="Email" class="field" /></br>
				<input type="submit" name="submit" value="Reset Password" id="sub-button">
			</form>
			
			<a href="auth.php"><p class="sub">Want to sign in?</p></a>
		</div>
	</div>
	
</body>

<?php include 'footer.php'; ?>

