<?php
    include '..\session.php';

    if($sessionStarted == false)
    {
       header('Location: /~orient/');
    }

    // Get the user information provided through POST
    $id         = $_SESSION['USER_ID'];
    $fname      = $_POST['fname'];
    $lname      = $_POST['lname'];
    $profile    = $_POST['profile'];
    $title      = $_POST['title'];
    $hometown   = $_POST['hometown'];
    $phone_num  = $_POST['phone-num'];
    $bio        = $_POST['bio'];

    echo $profile;

    include 'database.php';

    if($fname !== '')
    {
        $sql = 'UPDATE USERS SET FNAME= :FNAME WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':FNAME', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    if($lname !== '')
    {
        $sql = 'UPDATE USERS SET LNAME= :LNAME WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':LNAME', $lname, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    if($title !== '')
    {
        $sql = 'UPDATE USERS SET TITLE= :TITLE WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':TITLE', $title, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    if($hometown !== '')
    {
        $sql = 'UPDATE USERS SET HOMETOWN= :HOMETOWN WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':HOMETOWN', $hometown, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    if($phone_num !== '')
    {
        $sql = 'UPDATE USERS SET PHONE_NUM= :PHONE_NUM WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':PHONE_NUM', $phone_num, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    if($bio !== '')
    {
        $sql = 'UPDATE USERS SET BIO= :BIO WHERE USER_ID= :USER_ID';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':BIO', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':USER_ID', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    //header( "Location: ../profile.php" );
?>
