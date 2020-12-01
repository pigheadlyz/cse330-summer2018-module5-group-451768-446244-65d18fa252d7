<?php
header("Content-Type: application/json");
require('./database.php');
if(!isset($_SESSION)){
	session_start();
}

$json = json_decode(file_get_contents("php://input"),true);
ini_set("session.cookie_httponly", 1);
//get user name and check permission 
if (isset($_SESSION['username']) && $json['token'] == $_SESSION['token'])  {
	$id = $json['id'];
	$othername = $json['othername'];
	$title = $json['title'];
	$time = $json['time'];
	$tag = "";
//get all user information
	$stmt = $mysqli->prepare("SELECT * FROM user WHERE username=?");
	$stmt->bind_param('s',$othername);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$stmt->close();


	//check if the return result greater than 1 and add them into otheruser
	if(!empty($row)){
		$stmt = $mysqli->prepare("insert into event (username,title,date,tag) values (?, ?, ?,?)");
		$stmt->bind_param('ssss',$othername,$title,$time,$tag);
		$stmt->execute();
		$stmt->close();
		echo json_encode(array(
		"success" => true,
		"message" => "You have share a event!"
		));
		exit;
	}else{
		echo json_encode(array(
			"success" => false,
			"message" => "Invalid Username for sharing!"
		));
		exit;
   	}





}else{
	echo json_encode(array(
		"success" => false,
		"message" => "Please Login first"
	));
	exit;
}
?>
