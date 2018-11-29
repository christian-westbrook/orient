<?php
$css = array(
		0 => 'signup'
	    );
include 'header.php';
$email   = $_POST['email'];
$userid   = $_POST['userid'];
?>

<div id="container">
	<div id="auth">
		<p id="label">ORIENT</p>
    <p id="label">Reset Password</p>
		<form action="php/reset-password-script.php" method="post">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
			<input type="hidden" name="userid" value="<?php echo $userid; ?>">
			<input type="password" name="password" placeholder="New Password" class="field" /></br>
			<input type="password" name="confirm" placeholder="New Password Again" class="field" /></br>
			<input type="submit" value="Reset" id="sub-button">
		</form>
	</div>
</div>
<?php include 'footer.php'; ?>
