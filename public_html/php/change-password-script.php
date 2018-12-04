<?php
    include '../session.php';

    // Get the user information provided through POST
	$old_password   = $_POST['old-password'];
    $new_password   = $_POST['new-password'];
    $confirm        = $_POST['confirm-password'];
    $id             = $_SESSION['USER_ID'];

    include 'database.php';

	$sql  = 'SELECT PASSWORD FROM USERS WHERE USER_ID= :USER_ID';

    $stmt = $conn->prepare($sql);
	$stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);

    if($stmt->execute())
	{
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($results && password_verify($old_password, $results[0]['PASSWORD']) && ($new_password == $confirm))
		{
            $ciphertext = password_hash($new_password, PASSWORD_DEFAULT);

            $sql = 'UPDATE USERS SET PASSWORD= :PASSWORD WHERE USER_ID= :USER_ID';

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
            $stmt->bindParam(':PASSWORD', $ciphertext, PDO::PARAM_STR);

            if($stmt->execute())
        	{
                header( "Location: ../settings.php" );
            }
            else
            {
                echo "Unable to update database.";
            }
        }
    }
?>
