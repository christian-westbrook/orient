<?php

include_once('session.php');

if(closeSession())
{
	header('Location: /~iot3/');
}
?>
