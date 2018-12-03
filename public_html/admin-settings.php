<?php

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
if(!$_SESSION['ROLE_ID'] == 5)
{
   header('Location: /~orient/settings.php');
}
$id         = $_SESSION['USER_ID'];
include 'php/database.php';
$sqlEMP = 'SELECT * FROM EMPLOYERS';
$sqlUNI = 'SELECT * FROM UNIVERSITIES';
$sqlINT = 'SELECT * FROM INTERESTS';
$sqlSKL = 'SELECT * FROM SKILLS';
$sqlROL = 'SELECT * FROM ROLES';
$sqlPUB = 'SELECT * FROM PUBLICATIONS';
$sqlDEP = 'SELECT * FROM DEPARTMENTS';

$stmtEMP = $conn->prepare($sqlEMP);
$stmtEMP->execute();
$stmtUNI = $conn->prepare($sqlUNI);
$stmtUNI->execute();
$stmtINT = $conn->prepare($sqlINT);
$stmtINT->execute();
$stmtSKL = $conn->prepare($sqlSKL);
$stmtSKL->execute();
$stmtROL = $conn->prepare($sqlROL);
$stmtROL->execute();
$stmtPUB = $conn->prepare($sqlPUB);
$stmtPUB->execute();
$stmtDEP = $conn->prepare($sqlDEP);
$stmtDEP->execute();

$sqlNU = 'SELECT * FROM USERS';
$stmtNU = $conn->prepare($sqlNU);
$stmtNU->execute();

?>

<div id="container">
	<div id="settings">
		<p id="heading">Settings</p>
		
		<form action="php/admin-profile-script.php" method="POST">
		
			<select name="newuserid" class="field">
			<option value="ignore">Select A User</option>
			<?php
				$valNU = $stmtNU->fetchAll(PDO::FETCH_ASSOC);
				$lenNU = count($valNU);
				for($i = 0; $i < $lenNU; $i++){
			?>
			<option value="<?php echo $valNU[$i]['USER_ID'];?>"><?php echo $valNU[$i]['FNAME']." ".$valNU[$i]['LNAME'];?></option>
			<?php } ?>
			</select>
			<br>
			<br>			
			<input type="file" class="field" name="profile" accept="image/*" /></br>
			<input type="submit" value="Update Profile Picture" class="sub-button" name="pic-sub"></br>

			<input type="text" name="fname" placeholder="First Name" class="field" /></br>
			<input type="text" name="lname" placeholder="Last Name" class="field" /></br>
			<input type="text" name="email" placeholder="Change Email" class="field" /></br>
			<input type="text" name="title" placeholder="Title" class="field" /></br>
			<input type="text" name="hometown" placeholder="Hometown" class="field" /></br>
			<input type="text" name="phone-num" placeholder="XXX-XXX-XXXX" class="field" /></br>
			<input type="textarea" rows="4" wrap="hard" name="bio" placeholder="Research Summary" class="field" id="research-summary"/></br>
			<select name="role" class="field">
				<option value="ignore">Select A New Role</option>
				<?php
					$valz = $stmtROL->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					for($i = 0; $i < $length; $i++){
				?>
				<option value="<?php echo $valz[$i]['ROLE_ID'];?>"><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="department" class="field">
				<option value="ignore">Select A New Role</option>
				<?php
					$valz = $stmtDEP->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					for($i = 0; $i < $length; $i++){
				?>
				<option value="<?php echo $valz[$i]['DEP_ID'];?>"><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
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
					for($i = 0; $i < $length; $i++){
				?>
				<option value="<?php echo $valz[$i]['INT_ID'];?>"><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="skill[]" class="field2" multiple>
				<option value="ignore">Select Your Skills</option>
				<?php
					$valz = $stmtSKL->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					for($i = 0; $i < $length; $i++){
				?>
				<option value="<?php echo $valz[$i]['SKILL_ID'];?>"><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="publications" class="field2" multiple>
				<option value="ignore">Select Publication(s)</option>
				<?php
					$valz = $stmtPUB->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					for($i = 0; $i < $length; $i++){
				?>
				<option value="<?php echo $valz[$i]['PUB_ID'];?>"><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<input type="submit" value="Update Information" class="sub-button">
		</form>
		<p id="heading">Add New Values</p>
		<form action="php/add2db-script.php" method="POST">
			<input type="text" name="newrole" placeholder="Role" class="field" /></br>
			<input type="text" name="newpublication" placeholder="Publication" class="field" /></br>
			<input type="text" name="newskill" placeholder="Skill" class="field" /></br>
			<input type="text" name="newinterest" placeholder="Interest" class="field" /></br>
			<input type="text" name="newuniversity" placeholder="University" class="field" /></br>
			<input type="text" name="newemployer" placeholder="Employer" class="field" /></br>
			<input type="text" name="newdepartment" placeholder="Department" class="field" /></br>
			<input type="submit" value="Add" class="sub-button">
		</form>
	</div>
</div>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
