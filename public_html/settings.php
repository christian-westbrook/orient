<?php

/**************************************************************************
 * System	: Open-source Research Interest Network
 * Version	: Prototype System II
 * File		: settings.php
 * Developers 	: Anthony Todaro, Christian Westbrook
 *
 * Abstract 	:
 **************************************************************************/

$css = array(
				0 => 'settings'
	    	);

$js = array(
				0 => 'validatePassword'
	   		);

include('header.php');

if($sessionStarted == false)
{
   header('Location: /~orient/');
}
include 'php/database.php';
$sqlEMP = 'SELECT NAME FROM EMPLOYERS';
$sqlUNI = 'SELECT NAME FROM UNIVERSITIES';
$sqlINT = 'SELECT NAME FROM INTERESTS';
$sqlSKL = 'SELECT NAME FROM SKILLS';
$stmtEMP = $conn->prepare($sqlEMP);
$stmtEMP->execute();
$stmtUNI = $conn->prepare($sqlUNI);
$stmtUNI->execute();
$stmtINT = $conn->prepare($sqlINT);
$stmtINT->execute();
$stmtSKL = $conn->prepare($sqlSKL);
$stmtSKL->execute();

?>

<div id="container">
	<div id="settings">
		<p id="heading">Settings</p>

		<p class="label">Change Email</p>

		<form action="php/change-email-script.php" method="POST">
			<input type="text" name="email" placeholder="New Email" class="field" /></br>
			<input type="text" name="confirm-email" placeholder="Confirm" class="field" /></br>
			<input type="submit" value="Change Email" class="sub-button">
		</form>

		<p class="label">Change Password</p>

		<form action="php/change-password-script.php" method="POST">
			<input type="password" name="old-password" placeholder="Old Password" class="field" /></br>
			<input type="password" name="new-password" placeholder="New Password" class="field" /></br>
			<input type="password" name="confirm-password" placeholder="Confirm" class="field" /></br>
			<input type="submit" value="Change Password" class="sub-button">
		</form>

		<p class="label">Update Profile Picture</p>

		<form action="php/update-profile-picture-script.php" method="POST">
			<input type="file" class="field" name="profile" accept="image/*" /></br>
			<input type="submit" value="Update Profile Picture" class="sub-button" name="pic-sub">
		</form>

		<p class="label">Update Profile Information</p>

		<form action="php/update-profile-script.php" method="POST">
			<input type="text" name="fname" placeholder="First Name" class="field" /></br>
			<input type="text" name="lname" placeholder="Last Name" class="field" /></br>
			<input type="text" name="title" placeholder="Title" class="field" /></br>
			<input type="text" name="hometown" placeholder="Hometown" class="field" /></br>
			<input type="text" name="phone-num" placeholder="XXX-XXX-XXXX" class="field" /></br>
			<input type="textarea" name="bio" placeholder="Bio" class="field" /></br>
			<select name="employer">				
				<option value="ignore">Select An Employer</option>
				<?php while ($valz = $stmtEMP->fetchAll(PDO::FETCH_ASSOC)){ ?>
				<option value="<?php echo $valz[0]['NAME'];?>"><?php echo $valz[0]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="university">				
				<option value="ignore">Select A University</option>
				<?php while ($valz = $stmtUNI->fetchAll(PDO::FETCH_ASSOC)){ ?>
				<option value="<?php echo $valz[0]['NAME'];?>"><?php echo $valz[0]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="interest" multiple>				
				<option value="ignore">Select Your Interests</option>
				<?php while ($valz = $stmtINT->fetchAll(PDO::FETCH_ASSOC)){ ?>
				<option value="<?php echo $valz[0]['NAME'];?>"><?php echo $valz[0]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="skill" multiple>				
				<option value="ignore">Select Your Skills</option>
				<?php while ($valz = $stmtSKL->fetchAll(PDO::FETCH_ASSOC)){ ?>
				<option value="<?php echo $valz[0]['NAME'];?>"><?php echo $valz[0]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<input type="submit" value="Update Information" class="sub-button">
		</form>
	</div>
</div>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
