<?php
    include '../session.php';

	// Get the user information provided through POST
    $id         = $_SESSION['USER_ID'];

	include 'database.php';

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

	header( "Location: ../profile.php" );
?>
