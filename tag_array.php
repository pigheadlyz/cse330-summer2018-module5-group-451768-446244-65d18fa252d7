<?php
header("Content-Type: application/json");
require('./database.php');
session_start();
$json = json_decode(file_get_contents("php://input"),true);
ini_set("session.cookie_httponly", 1);
if (sset($_SESSION['username']) && $json['token'] == $_SESSION['token'])  {
	//get user name and event  id 
	$id_array=array();
	$tag = $_POST['insert_tag'];
	$id = $json['id'];

	//print information for these tag
	$sql= "UPDATE event SET tag='".$tag."' WHERE id ='".$id."'";

	if ($mysqli->query($sql) === true) {
		echo json_encode(array(
			"success" => true,
			"message" => "Insert!"
		));
			exit;
	}else{
		echo json_encode(array(
			"success" => false,
			"message" => "Wrong insert!"
		));
		exit;
	}


}
else{
	echo json_encode(array(
		"success" => false,
		"message" => "Please Login first"
	));
	exit;
}

?>
