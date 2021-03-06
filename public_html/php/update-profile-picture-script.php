<?php
    include '../session.php';

    // Get the user information provided through POST
    $id             = $_SESSION['USER_ID'];
    $profile        = $_POST['profile'];

    if(is_uploaded_file($_FILES['profile']['tmp_name']) && (substr($_FILES['profile']['type'], 0, 6) == 'image/'))
    {
        $target = './img/users/' . $id . '.' . substr($_FILES['profile']['type'], 6);

        include 'database.php';
        $sql = 'UPDATE USERS SET PROFILE= :PROFILE WHERE USER_ID= :USER_ID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':PROFILE', $target, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_INT);
        $stmt->execute();

        $target = '.' . $target;

        move_uploaded_file($_FILES['profile']['tmp_name'], $target);
    }

    header( "Location: ../profile.php" );
?>
