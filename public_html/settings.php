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
$id         = $_SESSION['USER_ID'];
include 'php/database.php';
$sqlEMP = 'SELECT * FROM EMPLOYERS';
$sqlUNI = 'SELECT * FROM UNIVERSITIES';
$sqlINT = 'SELECT * FROM INTERESTS';
$sqlSKL = 'SELECT * FROM SKILLS';
$stmtEMP = $conn->prepare($sqlEMP);
$stmtEMP->execute();
$stmtUNI = $conn->prepare($sqlUNI);
$stmtUNI->execute();
$stmtINT = $conn->prepare($sqlINT);
$stmtINT->execute();
$stmtSKL = $conn->prepare($sqlSKL);
$stmtSKL->execute();
$selected;

$admin= False;
if($_SESSION['ROLE_ID'] == 5) $admin= True;

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
			<input type="textarea" rows="4" wrap="hard" name="bio" placeholder="Research Summary" class="field" id="research-summary"/></br>
			<select name="employer" class="field">
				<option value="ignore">Select An Employer</option>
				<?php
					$valz = $stmtEMP->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					for($i = 0; $i < $length; $i++){
				?>
				<option value="<?php echo $valz[$i]['EMP_ID'];?>"><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="university" class="field">
				<option value="ignore">Select A University</option>
				<?php
					$valz = $stmtUNI->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					for($i = 0; $i < $length; $i++){
				?>
				<option value="<?php echo $valz[$i]['UNIV_ID'];?>"><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="interest[]" class="field2" multiple>
				<option value="ignore">Select Your Interests</option>
				<?php
					$valz = $stmtINT->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					$sql = 'SELECT * FROM USERS_INTERESTS WHERE USER_ID= :USER_ID AND INT_ID= :INT_ID';
					for($i = 0; $i < $length; $i++){
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':INT_ID', $valz[$i]['INT_ID'], PDO::PARAM_INT);
						$stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
						$stmt->execute();
						$valz2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$length2 = count($valz2);
						if($length2>0){$selected='selected';}
						else{$selected='';}
				?>
				<option value="<?php echo $valz[$i]['INT_ID'];?>"<?php echo $selected;?>><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="skill[]" class="field2" multiple>
				<option value="ignore">Select Your Skills</option>
				<?php
					$valz = $stmtSKL->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					$sql = 'SELECT * FROM USERS_SKILLS WHERE USER_ID= :USER_ID AND SKILL_ID= :SKILL_ID';
					for($i = 0; $i < $length; $i++){
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':SKILL_ID', $valz[$i]['SKILL_ID'], PDO::PARAM_INT);
						$stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
						$stmt->execute();
						$valz2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$length2 = count($valz2);
						if($length2>0){$selected='selected';}
						else{$selected='';}
				?>
				<option value="<?php echo $valz[$i]['SKILL_ID'];?>" <?php echo $selected;?>><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<input type="submit" value="Update Information" class="sub-button">
		</form>
	</div>
</div>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
