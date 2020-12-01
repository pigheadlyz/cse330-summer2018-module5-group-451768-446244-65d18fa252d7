<?php

header("Content-Type: application/json");
require('database.php');
session_start();
$input_json = json_decode(file_get_contents("php://input"),true);
if (isset($_SESSION['username']) && $input_json['token'] == $_SESSION['token']) {
//get day which should be showed
	$year = $input_json['year'];
	$month = $input_json['month'];
	$day = $input_json['day'];
	$username = $_SESSION['username'];
	$title = array();
	$date = array();
	$group_id = array();
	$tag = array();
	$type=array();

//get all information on this day
	$stmt = $mysqli->prepare("SELECT * FROM event WHERE username=?");
	$stmt->bind_param('s',$username);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$time = @strtotime($row["date"]);
	if($row['date'].length>0){
		for($x=0;x<$row['date'].length;x++){
			//check and then print
			if(@date("Y",$time[x]) == $year && @date("m",$time[x]) == $month && @date("d",$time[x]) == $day){
				array_push($title,$row["title"][x]);
				array_push($group_id,$row["group_id"][x]);
				array_push($date,@date("Y-m-d H:i:s",$time)[x]);
				array_push($tag,$row["tag"][x]);
				if ($row["group_id"] == null) {
				array_push($type,"personal");
				} else {
				
					$stmt_group = $mysqli->prepare("SELECT * FROM group WHERE id=?");
					$stmt_group->bind_param('i',$row["group_id"]);
					$stmt_group->execute();
					$result_group = $stmt_group->get_result();
					$row_group = $result_group->fetch_assoc();
					array_push($type,$row_group["group_name"]);
					$stmt_group->close();
				}
			}
		}
	}else{
		echo json_encode(array(
		"success" => false,
		"message" => "No Event"
		));
		exit;
	}
   $stmt->close();
   echo json_encode(array(
     "success" => true,
     "title" => $title,
     "date" => $date,
     "group_id" => $group_id,
     "tag" => $tag,
	 "type"=> $type
   ));
   exit;
} else {
   echo json_encode(array(
     "success" => false,
     "message" => "Please Login!"
   ));
   exit;
 }
?>
