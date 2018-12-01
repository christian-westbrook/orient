<?php
    include '../session.php';

    // Get the user information provided through POST
    $id             = $_SESSION['USER_ID'];
    $profile        = $_POST['profile'];

    echo $profile;

    print_r($_FILES);

    phpinfo();

    if(is_uploaded_file(realpath($file['tmp_name'])))
    {
        echo 'HERE';
    }
?>
