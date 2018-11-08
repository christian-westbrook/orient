<?php
    include '..\session.php';

    if($sessionStarted == false)
    {
       header('Location: /~orient/');
    }

    // Get the user information provided through POST
    $id         = $_SESSION['USER_ID'];
    $profile    = $_POST['profile'];
    echo $profile;
?>
