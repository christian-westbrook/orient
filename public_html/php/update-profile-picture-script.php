<?php
    include '../session.php';

    // Get the user information provided through POST
    $id             = $_SESSION['USER_ID'];
    $profile        = $_POST['profile'];

    echo $profile;

    print_r($_FILE);

    if(is_uploaded_file(realpath($profile['tmp_name'])))
    {
        echo 'HERE';
    }
?>
