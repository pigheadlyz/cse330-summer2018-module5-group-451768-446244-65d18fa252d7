<?php
header("Content-Type: application/json");
require('database.php');

if(!isset($_SESSION)){
	session_start();
}
$json = json_decode(file_get_contents("php://input"),true);
//check user name 
if (isset($_SESSION['username']) && $json['token'] == $_SESSION['token']) {
	$title = $json['title'];
	//$body = $json['body'];
	$date = $json['date'];
	$id = $json['id'];
	$tag = $json['tagID'];

//after check then update
	$sql= "UPDATE event SET title='".$title."', date='".$date."' , tag='".$tag."' WHERE id ='".$id."'";

	if ($mysqli->query($sql) === true) {
		echo json_encode(array(
			"success" => true,
			"message" => "Update!"
		));
			exit;
	}else{
		echo json_encode(array(
			"success" => false,
			"message" => "Wrong update!"
		));
		exit;
	}
}else {
  echo json_encode(array(
		"success" => false,
		"message" => "You don't have permission!"
  ));
  exit;
}
?>
