<?php
    include '../session.php';

    // Get the user information provided through POST
    $id         = $_SESSION['USER_ID'];
    $fname      = $_POST['fname'];
    $lname      = $_POST['lname'];
    $title      = $_POST['title'];
    $hometown   = $_POST['hometown'];
    $phone_num  = $_POST['phone-num'];
    $bio        = $_POST['bio'];

    $employer   = $_POST['employer'];
    $university = $_POST['university'];

    include 'database.php';

    if($fname !== '')
    {
        $sql = 'UPDATE USERS SET FNAME= :FNAME WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':FNAME', $fname, PDO::PARAM_STR);
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
/*
    if($employer !== 'ignore')
    {
        $sql = 'UPDATE USERS SET EMP_ID= :EMP_ID WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':EMP_ID', $employer, PDO::PARAM_INT);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    if($university !== 'ignore')
    {
        $sql = 'UPDATE USERS SET UNIV_ID= :UNIV_ID WHERE USER_ID= :USER_ID';
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':UNIV_ID', $university, PDO::PARAM_INT);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute()
    }

    foreach ($_POST['interest'] as $intid){
        if($intid !== 'ignore')
        {
            $sql = 'SELECT * FROM USERS_INTERESTS WHERE USER_ID= :USER_ID AND INT_ID= :INT_ID';
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':INT_ID', $intid, PDO::PARAM_INT);
            $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
            $stmt->execute();
            $valz = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    $length = count($valz);
            if(!$length>0)
            {
                $sql = 'INSERT INTO USERS_INTERESTS (USER_ID, INT_ID) VALUES(:USER_ID, :INT_ID)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':INT_ID', $intid, PDO::PARAM_INT);
                $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }
    */
    foreach ($_POST['skill'] as $skillid){
        if($skillid !== 'ignore')
        {
            $sql = 'SELECT * FROM USERS_SKILLS WHERE USER_ID= :USER_ID AND SKILL_ID= :SKILL_ID';
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':SKILL_ID', $skillid, PDO::PARAM_INT);
            $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
            $stmt->execute();
	    $valz = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    $length = count($valz);
            if(!$length>0)
            {
                $sql = 'INSERT INTO USERS_SKILLS (USER_ID, SKILL_ID) VALUES(:USER_ID, :SKILL_ID)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':SKILL_ID', $skillid, PDO::PARAM_INT);
                $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }

    header( "Location: ../profile.php" );
?>
