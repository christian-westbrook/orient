<?php
/**************************************************************************
 * System	: Open-source Research Interest Network
 * Version	: Prototype System II
 * File		: profile.php
 * Developers 	: Christian Westbrook
 *
 * Abstract 	:
 **************************************************************************/

$css = array(
				0 => 'profile'
	    	);

include('header.php');

if($sessionStarted == false)
{
   header('Location: /~orient/');
}

?>

<div id="container">
	<div id="profile">

	</div>
</div>

</body>

<!-- Defines the footer of each page -->
<?php include('footer.php'); ?>
