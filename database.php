<?php

$mysqli = new mysqli('localhost', 'root', 'wustl_pass', 'module5');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>
