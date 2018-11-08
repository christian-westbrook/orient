<?php
    include '..\session.php';

    // Get the user information provided through POST
    $id             = $_SESSION['USER_ID'];
    $profile        = $_POST['profile'];

    $target_dir     = "img/users/";
    $target_file    = $target_dir . basename($_FILES["profile"]["name"]);

    $ok         = true;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    /*// Check if image file is a actual image or fake image
    if(isset($_POST["pic-sub"]))
    {
        $check = getimagesize($_FILES["profile"]["tmp_name"]);
        if($check !== false)
        {
            $ok = true;
        }
        else
        {
            $ok = false;
        }
    }*/

    // Limit file size
    if ($_FILES["profile"]["size"] > 500000)
    {
        echo "Image exceeds maximum file size of 500KB";
        $ok = false;
    }

    // Limit file format
    if($imageFileType != ".jpg" && $imageFileType != ".png" && $imageFileType != ".jpeg" && $imageFileType != ".gif" )
    {
        echo "Invalid file type.";
        $ok = false;
    }

    if(!$ok)
    {
        echo "Unable to upload image.";
    }
    else
    {
        if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file))
        {
            header( "Location: ../profile.php" );
        }
        else
        {
            echo "Unable to upload image.";
        }
    }
?>
