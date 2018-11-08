<?php
    include '..\session.php';

    // Get the user information provided through POST
    $id         = $_SESSION['USER_ID'];
    $profile    = $_POST['profile'];
    echo $profile;
?>
