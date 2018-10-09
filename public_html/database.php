<?php

/**************************************************************************
 * System	  : Optimized Research Interest Network
 * Version	  : Prototype System I
 * File		  : database.php
 * Developers : Christian Westbrook, Nicholas Leonard
 *
 * Abstract	  : 
 **************************************************************************/
 
$pdo = new PDO('mysql:host=orientdb.c86myvnpmoub.us-east-2.rds.amazonaws.com:3306;dbname=ORIENT','cwestbrook','orientdb');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
