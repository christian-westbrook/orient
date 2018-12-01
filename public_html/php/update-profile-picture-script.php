<?php
    include '../session.php';

    // Get the user information provided through POST
    $id             = $_SESSION['USER_ID'];
    $profile        = $_POST['profile'];

    if(is_uploaded_file($_FILES['profile.jpg']['tmp_name']))
    {
        echo 'HERE';
    }
?>
