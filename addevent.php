<?php
header("Content-Type: application/json");
require('./database.php');
if(!isset($_SESSION)){
	session_start();
}
$json = json_decode(file_get_contents("php://input"),true);
if (isset($_SESSION['username']) && $json['token'] == $_SESSION['token'])  {
//	$group = $json['group'];
	$username=$_SESSION['username'];
	$title = $json['title'];
	$date = $json['date'];
	$tag = $json['tagID'];
//	$group_name = $json['group_name'];
//	$group_user_name = $json['group_user_name']
//$group_user_id = array();
	//$tag = $json['tag'];
	//if (!$group) {
	//check user name and then add event
  $stmt = $mysqli->prepare("INSERT into event (username,title,date,tag) values (?, ?, ?,?)");
  $stmt->bind_param('ssss',$username,$title,$date,$tag);
  $stmt->execute();
  $stmt->close();
  echo json_encode(array(
    "success" => true,
    "message" => "You have add a event!(Individually)"
  ));
  exit;
		//}
	/*else{
		$stmt = $mysqli->prepare("select max(id) from group");
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		$group_id = $row['max(id)']+1;

		$stmt = $mysqli->prepare("insert into group (group_name) values (?)");
		$stmt->bind_param('s',$group_name);
		$stmt->execute();
		$stmt->close();

		for($number=0;$number<count(group_user_name);$number++){
			  $stmt = $mysqli->prepare("select id from user where username=?");
				$stmt->bind_param('s',$group_user_name[$x]);
				$stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();
				$stmt->close();
				if(!row['id']){
					echo json_encode(array(
          "success" => false,
          "message" => "Username Error!"
        ));
        exit;
				}
				else{
					array_push($group_user_id,htmlentities($row["id"]));
					$stmt = $mysqli->prepare("insert into event (user_id,title,body,time,tag,group_id) values (?, ?, ?, ?, ?,?)");
					$stmt->bind_param('issssi',$group_user_id[$number],$title,$body,$time,$tag,$group_id);
					$stmt->execute();
					$stmt->close();
				}
		}

}*/

}
else{
	echo json_encode(array(
		"success" => false,
		"message" => "Please Login first"
	));
	exit;
}

?>
