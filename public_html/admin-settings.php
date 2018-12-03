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

if(isset($_POST['newuseriddd'])) $id = $_POST['newuseriddd'];
else $id= $_SESSION['USER_ID'];

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

$sqlCU = 'SELECT * FROM USERS WHERE USER_ID= :USER_ID';
$stmtCU = $conn->prepare($sqlCU);
$stmtCU->bindParam(':USER_ID', $id, PDO::PARAM_INT);
$stmtCU->execute();
$valCU = $stmtCU->fetchAll(PDO::FETCH_ASSOC);
?>
<div id="container">
	<div id="settings">
		<p id="heading">Settings</p>
		<form action="#" method="POST">
			<select name="newuseriddd" class="field" onchange="this.form.submit()">
			<?php
				$valNU = $stmtNU->fetchAll(PDO::FETCH_ASSOC);
				$lenNU = count($valNU);
				for($i = 0; $i < $lenNU; $i++){
				if($valNU[$i]['USER_ID'] == $id){$selected='selected';}
				else{$selected='';}
			?>
			<option value="<?php echo $valNU[$i]['USER_ID'];?>" <?php echo $selected;?>><?php echo $valNU[$i]['FNAME']." ".$valNU[$i]['LNAME'];?></option>
			<?php } ?>
			</select>
			<br>
		</form>
		<form action="php/admin-profile-script.php" method="POST">
			<input type="hidden" name="newuserid" value="<?php echo $id;?>" class="field" />		
			<input type="file" class="field" name="profile" accept="image/*" /></br>

			<input type="text" name="fname" value="<?php echo $valCU[0]['FNAME'];?>" class="field" /></br>
			<input type="text" name="lname" value="<?php echo $valCU[0]['LNAME'];?>" class="field" /></br>
			<input type="text" name="email" value="<?php echo $valCU[0]['EMAIL'];?>" class="field" /></br>
			<input type="text" name="title" value="<?php echo $valCU[0]['TITLE'];?>" class="field" /></br>
			<input type="text" name="hometown" value="<?php echo $valCU[0]['HOMETOWN'];?>" class="field" /></br>
			<input type="text" name="phone-num" value="<?php echo $valCU[0]['PHONE_NUM'];?>" class="field" /></br>
			<textarea rows="4" wrap="hard" name="bio" placeholder="Research Summary" class="field3"></textarea></br>
			<select name="role" class="field">
				<option value="ignore">--Select A New Role--</option>
				<?php
					$valz = $stmtROL->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					$sql = 'SELECT * FROM USERS WHERE USER_ID= :USER_ID AND ROLE_ID= :ROLE_ID';
					for($i = 0; $i < $length; $i++){
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':ROLE_ID', $valz[$i]['ROLE_ID'], PDO::PARAM_INT);
						$stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
						$stmt->execute();
						$valz2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$length2 = count($valz2);
						if($length2>0){$selected='selected';}
						else{$selected='';}
				?>
				<option value="<?php echo $valz[$i]['ROLE_ID'];?>" <?php echo $selected;?>><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="department" class="field">
				<option value="ignore">--Select A New Department--</option>
				<?php
					$valz = $stmtDEP->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					$sql = 'SELECT * FROM USERS WHERE USER_ID= :USER_ID AND DEP_ID= :DEP_ID';
					for($i = 0; $i < $length; $i++){
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':DEP_ID', $valz[$i]['DEP_ID'], PDO::PARAM_INT);
						$stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
						$stmt->execute();
						$valz2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$length2 = count($valz2);
						if($length2>0){$selected='selected';}
						else{$selected='';}
				?>
				<option value="<?php echo $valz[$i]['DEP_ID'];?>" <?php echo $selected;?>><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="employer" class="field">
				<option value="ignore">--Select An Employer--</option>
				<?php
					$valz = $stmtEMP->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					$sql = 'SELECT * FROM USERS WHERE USER_ID= :USER_ID AND EMP_ID= :EMP_ID';
					for($i = 0; $i < $length; $i++){
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':EMP_ID', $valz[$i]['EMP_ID'], PDO::PARAM_INT);
						$stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
						$stmt->execute();
						$valz2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$length2 = count($valz2);
						if($length2>0){$selected='selected';}
						else{$selected='';}
				?>
				<option value="<?php echo $valz[$i]['EMP_ID'];?>" <?php echo $selected;?>><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="university" class="field">
				<option value="ignore">--Select A University--</option>
				<?php
					$valz = $stmtUNI->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					$sql = 'SELECT * FROM USERS WHERE USER_ID= :USER_ID AND UNIV_ID= :UNIV_ID';
					for($i = 0; $i < $length; $i++){
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':UNIV_ID', $valz[$i]['UNIV_ID'], PDO::PARAM_INT);
						$stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
						$stmt->execute();
						$valz2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$length2 = count($valz2);
						if($length2>0){$selected='selected';}
						else{$selected='';}
				?>
				<option value="<?php echo $valz[$i]['UNIV_ID'];?>" <?php echo $selected;?>><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="interest[]" class="field2" multiple>
				<option value="ignore">--Select Your Interests--</option>
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
				<option value="<?php echo $valz[$i]['INT_ID'];?>" <?php echo $selected;?>><?php echo $valz[$i]['NAME'];?></option>
				<?php } ?>
			</select><br>
			<select name="skill[]" class="field2" multiple>
				<option value="ignore">--Select Your Skills--</option>
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
			<select name="publications[]" class="field2" multiple>
				<option value="ignore">--Select Publication(s)--</option>
				<?php
					$valz = $stmtPUB->fetchAll(PDO::FETCH_ASSOC);
					$length = count($valz);
					$sql = 'SELECT * FROM USERS_PUBLICATIONS WHERE USER_ID= :USER_ID AND PUB_ID= :PUB_ID';
					for($i = 0; $i < $length; $i++){
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':PUB_ID', $valz[$i]['PUB_ID'], PDO::PARAM_INT);
						$stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
						$stmt->execute();
						$valz2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$length2 = count($valz2);
						if($length2>0){$selected='selected';}
						else{$selected='';}
				?>
				<option value="<?php echo $valz[$i]['PUB_ID'];?>" <?php echo $selected;?>><?php echo $valz[$i]['NAME'];?></option>
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
