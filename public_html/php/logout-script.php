<?php
include '../session.php';

if(closeSession())
{
	header('Location: /~orient/');
}

?>
