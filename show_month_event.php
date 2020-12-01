<?php

header("Content-Type: application/json");
require('database.php');

session_start();
$input_json = json_decode(file_get_contents("php://input"),true);
if (isset($_SESSION['username']) && $input_json['token'] == $_SESSION['token']) {
//get month
	$year = $input_json['year'];
	$month = $input_json['month'];
	$username = $_SESSION['username'];
	$date= array();
	$group = array();

//get all event information of this month
	$stmt = $mysqli->prepare("SELECT * FROM event WHERE username=?");
	$stmt->bind_param('s',$username);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		$time = @strtotime($row["date"]);
     if (intval(@date("Y",$time))== $year &&intval(@date("m",$time))== $month) {
		 //check and print
       if ($row["group_id"] == null) {
           array_push($date,intval(@date("d",$time)));
       } else {
           array_push($group,intval(@date("d",$time)));
       }
     }
	}
   $stmt->close();

   echo json_encode(array(
     "success" => true,
     "message" => "successfully load!",
     "date" => $date,
     "group" => $group
   ));
   exit;
 } else {
   echo json_encode(array(
     "success" => false,
     "message" => "Please login!"
   ));
   exit;
 }
?>
