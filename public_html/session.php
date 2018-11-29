<?php
/**************************************************************************
 * System	  : Open-source Research Interest Network
 * Version	  : Prototype System II
 * File		  : session.php
 * Developers : Christian Westbrook
 *
 * Abstract	  :
 **************************************************************************/

// Starts the PHP session by creating/retrieving the $_SESSION associative array.
session_start();

//====================================================================
// Function	: checkSession()
// Abstract : Checks to see if the session was created correctly.
//
// Input	:
// Process	: Check to see if the key 'ID' is set in the $_SESSION
//            associative array. If it has been set then we know that
//            our createSession() function has executed and the function
//            can return true. If it hasn't been set then the function
//            will return false.
//
// Output	: A true or false value indicating whether the session has
//            already been created correctly.
//====================================================================
function checkSession()
{
	// Ternary operation
	// If the key 'ID' is set in the _SESSION associative array, return true. Else, return false.
	return isset($_SESSION['USER_ID']) ? true : false;
}

//====================================================================
// Function	: createSession()
// Abstract : Creates the session by storing a properly authenticated
//            user's USER_ID, EMAIL, USERNAME, FNAME, and LNAME values
//            to the $_SESSION associative array as retrieved from the
//            ORIENT database.
//
// Input	: User information in the form of an associative array with
//            the following keys set:
//
//			  USER_ID  - User primary key
//			  EMAIL    - User email address
//			  USERNAME - User display name
//            FNAME    - User first name
//			  LNAME    - User last name
//
// Process	: Move data from the input array into the $_SESSION array.
//
// Output	: The globally accessible $_SESSION associative array has
//            now been loaded with user related information to be used
//            throughout the system.
//====================================================================
function createSession($info)
{
	$_SESSION['USER_ID']        = $info['USER_ID'];
	$_SESSION['ROLE_ID']		= $info['ROLE_ID'];
}

//====================================================================
// Function	: closeSession()
// Abstract : If a session was properly created, destroy the session
//            and return a boolean indicating whether the action was
//            successful.
//
// Input	:
// Process	: If the session exists, destroy the session and then return
//            true to signify that a session was found and destroyed. If
//            the session was never created then return false signifying
//            that no action has been taken.
//
// Output	: The session has been destroyed by destroying the $_SESSION
//            associative array.
//====================================================================
function closeSession()
{
	if(checkSession())
	{
		session_destroy();
		return true;
	}
	else
	{
		return false;
	}
}

// This variable contains a boolean indicating whether the session has
// been created and loaded with user data or not.
$sessionStarted = checkSession();
?>
