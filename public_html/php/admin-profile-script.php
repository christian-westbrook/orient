<?php
    include '../session.php';
    include 'database.php';
    // Get the user information provided through POST
    $email          = $_POST['email'];
    $department     = $_POST['department'];
    $id             = $_POST['newuserid'];
    $role           = $_POST['role'];
    $fname          = $_POST['fname'];
    $lname          = $_POST['lname'];
    $title          = $_POST['title'];
    $hometown       = $_POST['hometown'];
    $almamater      = $_POST['alma-mater'];
    $phone_num      = $_POST['phone-num'];
    $bio            = $_POST['bio'];
    $university     = $_POST['university'];
    $profile	    = $_POST['profile'];

    if(is_uploaded_file($_FILES['profile']['tmp_name']) && (substr($_FILES['profile']['type'], 0, 6) == 'image/'))
    {
        $target = './img/users/' . $id . '.' . substr($_FILES['profile']['type'], 6);
        $sql = 'UPDATE USERS SET PROFILE= :PROFILE WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':PROFILE', $target, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
        $target = '.' . $target;
        move_uploaded_file($_FILES['profile']['tmp_name'], $target);
    }

    if($email !== '')
    {
        $sql = 'UPDATE USERS SET EMAIL= :EMAIL WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($fname !== '')
    {
        $sql = 'UPDATE USERS SET FNAME= :FNAME WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':FNAME', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($role !== 'ignore')
    {
        $sql = 'UPDATE USERS SET ROLE_ID= :ROLE_ID WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ROLE_ID', $role, PDO::PARAM_INT);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($department !== 'ignore')
    {
        $sql = 'UPDATE USERS SET DEP_ID= :DEP_ID WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':DEP_ID', $department, PDO::PARAM_INT);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($lname !== '')
    {
        $sql = 'UPDATE USERS SET LNAME= :LNAME WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':LNAME', $lname, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($title !== '')
    {
        $sql = 'UPDATE USERS SET TITLE= :TITLE WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':TITLE', $title, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($hometown !== '')
    {
        $sql = 'UPDATE USERS SET HOMETOWN= :HOMETOWN WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':HOMETOWN', $hometown, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($almamater !== '')
    {
        $sql = 'UPDATE USERS SET ALMA_MATER= :ALMA_MATER WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ALMA_MATER', $almamater, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($phone_num !== '')
    {
        $sql = 'UPDATE USERS SET PHONE_NUM= :PHONE_NUM WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':PHONE_NUM', $phone_num, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($bio !== '')
    {
        $sql = 'UPDATE USERS SET BIO= :BIO WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':BIO', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($university !== 'ignore')
    {
        $sql = 'UPDATE USERS SET UNIV_ID= :UNIV_ID WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':UNIV_ID', $university, PDO::PARAM_INT);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if(isset($_POST['interest']))
    {
	    $sql = 'DELETE FROM USERS_INTERESTS WHERE USER_ID= :USER_ID';
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
	    $stmt->execute();
    }
    foreach ($_POST['interest'] as $intid){
        if($intid !== 'ignore')
        {
            $sql = 'INSERT INTO USERS_INTERESTS (USER_ID, INT_ID) VALUES(:USER_ID, :INT_ID)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':INT_ID', $intid, PDO::PARAM_INT);
            $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    if(isset($_POST['skill']))
    {
	    $sql = 'DELETE FROM USERS_SKILLS WHERE USER_ID= :USER_ID';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
            $stmt->execute();
    }
    foreach ($_POST['skill'] as $skillid){
        if($skillid !== 'ignore')
        {
            $sql = 'INSERT INTO USERS_SKILLS (USER_ID, SKILL_ID) VALUES(:USER_ID, :SKILL_ID)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':SKILL_ID', $skillid, PDO::PARAM_INT);
            $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    header( "Location: ../admin-settings.php" );
?>
