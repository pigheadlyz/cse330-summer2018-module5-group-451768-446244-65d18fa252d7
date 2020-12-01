<?php
header("Content-Type: application/json");
require('./database.php');
if(!isset($_SESSION)){
	session_start();
}

$json = json_decode(file_get_contents("php://input"),true);
ini_set("session.cookie_httponly", 1);
//get user name 
if (isset($_SESSION['username']) && $json['token'] == $_SESSION['token'])  {
	$title=array();
	$date =array();
	$event_id=array();
	$tag = array();
//get all information 
	$stmt = $mysqli->prepare("select * from event where username=?");
	$stmt->bind_param('s', $_SESSION['username']);
	$stmt->execute();
	$result = $stmt->get_result();
//print them
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($title,htmlentities($row["title"]));
		array_push($date,htmlentities($row["date"]));
		array_push($tag,htmlentities($row["tag"]));
		array_push($event_id,htmlentities($row["id"]));
  }
	$stmt->close();


	echo json_encode(array(
		"success"=>true,
		"title" =>$title,
		"time" => $date,
		"id" => $event_id,
		"tag" => $tag,
	));
	exit;
}else{
	echo json_encode(array(
		"success" => false,
		"message" => "Please Login first"
	));
	exit;
}
?>
