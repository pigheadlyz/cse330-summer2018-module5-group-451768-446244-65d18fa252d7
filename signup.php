<?php
	include 'database2.php';
	header("Content-Type: application/json");
	//get user information 
	$input_json = json_decode(file_get_contents("php://input"),true);
	$username = $input_json['username'];
	$password = $input_json['password'];

	$uname = mysqli_real_escape_string($conn,$username );
	$pass = mysqli_real_escape_string($conn,$password);
	$uname_nospace = str_replace(' ', '', $uname);


	$sql="SELECT * FROM user WHERE username=?";

	//create prepare statement
	$stmt = mysqli_stmt_init($conn);

	//prepared the statement
	if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo json_encode(array(
			"success" => false,
			"message" => "Can't connect to Database"
			));
  exit;
	} else {
		//bind the parameter
		mysqli_stmt_bind_param($stmt,"s",$uname_nospace);

		//run the bind param
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if(mysqli_num_rows($result)>=1)

   		{
			echo json_encode(array(
				"success" => false,
				"username" => $username,
				"password" => $password,
				"message" => "Username already exit;"
				));

   		}
 		else
    	{

   		$hashpass = password_hash($pass, PASSWORD_DEFAULT);

		// $sql = "INSERT INTO userinfo (username, password) VALUES ('$uname_nospace','$hashpass')";

		// $result = $conn->query($sql);

		$stmt = mysqli_prepare($conn, "INSERT INTO user (username, password) VALUES (?,?)");

		mysqli_stmt_bind_param($stmt, 'ss', $uname,$hashpass);

		mysqli_stmt_execute($stmt);

		echo json_encode(array(
		"success" => true,
		"username" => $username,
		"password" => $password,
		"message" => "successfully signup!"
		));
		exit;
    	}

	}

?>
