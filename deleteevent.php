<?php
header("Content-Type: application/json");
require('database.php');

if(!isset($_SESSION)){
	session_start();
}
$json = json_decode(file_get_contents("php://input"),true);
//check username
if (isset($_SESSION['username']) && $json['token'] == $_SESSION['token']) {
	$id = $json['id'];
	$sql= "delete from event where id='".$id."'";
	//delete after check
	if ($mysqli->query($sql) === true) {
		echo json_encode(array(
			"success" => true,
			"message" => "DELETE!"
		));
		exit;
	}else{
		echo json_encode(array(
			"success" => false,
			"message" => "Wrong DELETE!"
		));
		exit;
	}
}else{
  echo json_encode(array(
	"success" => false,
	"message" => "You don't have permission. Please login!"
  ));
  exit;
}
?>
