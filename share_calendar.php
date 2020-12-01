<?php
header("Content-Type: application/json");
require('./database.php');
if(!isset($_SESSION)){
	session_start();
}

$json = json_decode(file_get_contents("php://input"),true);
ini_set("session.cookie_httponly", 1);
//check username 
if (isset($_SESSION['username']) && $json['token'] == $_SESSION['token'])  {
	$other_name = $json['othername'];
	$title=array();
	$date =array();
  $group_id=array();
	$tag = array();
//get all event from user
	$stmt = $mysqli->prepare("select * from event where username=?");
	$stmt->bind_param('s', $_SESSION['username']);
	$stmt->execute();



	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		array_push($title,$row["title"]);
		array_push($date,$row["date"]);
		array_push($tag,$row["tag"]);
		array_push($group_id,$row["group_id"]);
	}
	$stmt->close();
//check whether other_user exist
	$stmt = $mysqli->prepare("SELECT * FROM user WHERE username=?");
	$stmt->bind_param('s',$other_name);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$stmt->close();



	//check if the return result greater than 1 and add them into other_user
	if(!empty($row)){
		for($x=0;$x<count($title);$x++){
			$stmt = $mysqli->prepare("insert into event (username,title,date,group_id,tag) values (?, ?, ?,?,?)");
			$stmt->bind_param('sssis',$other_name,$title[$x],$date[$x],$group_id[$x],$tag[$x]);
			$stmt->execute();
			$stmt->close();
		}
		echo json_encode(array(
			"success" => true,
			"message" => "You have add a event!(Individually)"
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
