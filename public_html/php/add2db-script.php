<?php
  include 'database.php';

  // Get the user information provided through POST
  $newrole 		      = $_POST['newrole'];
  $newpublication 	= $_POST['newpublication'];
  $newskill		      = $_POST['newskill'];
  $newinterest		  = $_POST['newinterest'];
  $newuniversity 		= $_POST['newuniversity'];
  $newemployer 	    = $_POST['newemployer'];
  $newdepartment		= $_POST['newdepartment'];
  
  if(!$newrole=='')
  {
    $sql  = 'INSERT INTO ROLES (NAME) VALUES (:ROLE);';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ROLE', $newrole, PDO::PARAM_STR);
    if($stmt->execute()) header( "Location: ../admin-settings.php" );
    else echo "Something went wrong!";
  }

  if(!$newpublication=='')
    {
      $sql  = 'INSERT INTO PUBLICATIONS (NAME) VALUES (:PUB);';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':PUB', $newpublication, PDO::PARAM_STR);
      if($stmt->execute()) header( "Location: ../admin-settings.php" );
      else echo "Something went wrong!";
    }

  if(!$newskill=='')
    {
      $sql  = 'INSERT INTO SKILLS (NAME) VALUES (:SKL);';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':SKL', $newskill, PDO::PARAM_STR);
      if($stmt->execute()) header( "Location: ../admin-settings.php" );
      else echo "Something went wrong!";
    }

  if(!$newinterest=='')
    {
      $sql  = 'INSERT INTO INTERESTS (NAME) VALUES (:INT);';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':INT', $newinterest, PDO::PARAM_STR);
      if($stmt->execute()) header( "Location: ../admin-settings.php" );
      else echo "Something went wrong!";
    }

  if(!$newuniversity=='')
    {
      $sql  = 'INSERT INTO UNIVERSITIES (NAME) VALUES (:UNI);';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':UNI', $newuniversity, PDO::PARAM_STR);
      if($stmt->execute()) header( "Location: ../admin-settings.php" );
      else echo "Something went wrong!";
    }

  if(!$newemployer=='')
    {
      $sql  = 'INSERT INTO EMPLOYERS (NAME) VALUES (:EMP);';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':EMP', $newemployer, PDO::PARAM_STR);
      if($stmt->execute()) header( "Location: ../admin-settings.php" );
      else echo "Something went wrong!";
    }
  if(!$newdepartment=='')
      {
        $sql  = 'INSERT INTO DEPARTMENTS (NAME) VALUES (:DEP);';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':DEP', $newdepartment, PDO::PARAM_STR);
        if($stmt->execute()) header( "Location: ../admin-settings.php" );
        else echo "Something went wrong!";
      }
header( "Location: ../admin-settings.php" );
?>
