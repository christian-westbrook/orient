<?php
    include '../session.php';

    // Get the user information provided through POST
    $id             = $_SESSION['USER_ID'];
    $profile        = $_POST['profile'];

    if(is_uploaded_file($_FILES['profile']['tmp_name']) && (substr($_FILES['profile']['type'], 0, 6) == 'image/'))
    {
        $target = '../img/users/' . $id . '.' . substr($_FILES['profile']['type'], 6);
        echo $target;
        //move_uploaded_file($_FILES['profile']['tmp_name'], $target);
    }
?>
