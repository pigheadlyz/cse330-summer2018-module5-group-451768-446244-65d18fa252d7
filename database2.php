<?php
  $conn = mysqli_connect("localhost","root","wustl_pass","module5");

	if (!$conn) {
		die("Connection failed:" .mysqli_conect_error());
		exit;
	}
?>