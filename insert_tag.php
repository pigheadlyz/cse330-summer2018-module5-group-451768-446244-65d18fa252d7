<?php
header("Content-Type: application/json");
require('./database.php');
session_start();
$json = json_decode(file_get_contents("php://input"),true);
ini_set("session.cookie_httponly", 1);
//check username 
if (isset($_SESSION['username']) && $json['token'] == $_SESSION['token'])  {
	$event_id=$_POST['id'];
	$tag = $_POST['tag'];
	// update tag
	$stmt = $mysqli->prepare("UPDATE event SET tag=? where id=?"); 
	$stmt->bind_param('si', $tag,$id);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	

	echo json_encode(array(
	"success" => true,
	"message" => "ADD A TAG"
	));
	exit;
	


}
else{
	echo json_encode(array(
		"success" => false,
		"message" => "Please Login first"
	));
	exit;
}

?>
