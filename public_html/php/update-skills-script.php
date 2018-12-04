<?php
    include '../session.php';

	// Get the user information provided through POST
    $id         = $_SESSION['USER_ID'];

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

    header( "Location: ../profile.php" );
?>
