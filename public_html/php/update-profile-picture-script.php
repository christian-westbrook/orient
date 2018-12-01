<?php
    include '../session.php';

    // Get the user information provided through POST
    $id             = $_SESSION['USER_ID'];
    $profile        = $_POST['profile'];

    echo $profile;

    if (is_uploaded_file($_FILES['profile']['tmp_name']) )
    {
        //First, validate the file name
        if(empty($_FILES['profile']['name']))
        {
            echo " File name is empty! ";
            exit;
        }

        $upload_file_name = $_FILES['profile']['name'];
        //Too long file name?
        if(strlen ($upload_file_name)>100)
        {
            echo "File name is too long.";
            exit;
        }

        //replace any non-alpha-numeric cracters in th file name
        $upload_file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $upload_file_name);

        //set a limit to the file upload size
        if ($_FILES['profile']['size'] > 1000000)
        {
            echo "Exceeds maximum file size.";
            exit;
        }

        //Save the file
        $dest=__DIR__.'/img/users/' . $id . $upload_file_name;
        if (move_uploaded_file($_FILES['my_upload']['tmp_name'], $dest))
        {
            echo 'File Has Been Uploaded !';
        }

    }

?>
