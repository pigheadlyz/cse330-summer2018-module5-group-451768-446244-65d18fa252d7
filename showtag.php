<?php
header("Content-Type: application/json");
require('./database.php');
session_start();
$json = json_decode(file_get_contents("php://input"),true);
ini_set("session.cookie_httponly", 1);
if (sset($_SESSION['username']) && $json['token'] == $_SESSION['token'])  {
	//check user name and permission 
	$title=array();
	$date=array();
	$time=array();
	$tag = $_POST['tag'];
	$username=$_SESSION['username'];
	//get all information for special date
	$stmt = $mysqli->prepare("select * from event where username=? and tag=?"); 
	$stmt->bind_param('ss',$username, $tag);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($title,htmlentities($row["title"]));
		array_push($date,htmlentities($row["date"]));
    }
	$stmt->close();
	

	echo json_encode(array(
	"Title" =>$title,
	"Date" => $date,
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
