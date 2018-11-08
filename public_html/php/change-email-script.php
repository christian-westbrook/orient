<?php
    include '..\session.php';

    // Get the user information provided through POST
	$email      = $_POST['email'];
	$confirm    = $_POST['confirm-email'];
    $id         = $_SESSION['USER_ID'];

    if($email == $confirm)
    {
        include 'database.php';

        $sql = 'UPDATE USERS SET EMAIL= :EMAIL WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_STR);

        if($stmt->execute())
    	{
            header( "Location: ../profile.php" );
        }
        else
        {
            echo "Unable to update database.";
        }
    }
?>
