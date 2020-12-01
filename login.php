<?php
	include 'database2.php';
	header("Content-Type: application/json");

	if(!isset($_SESSION)){
		session_start();
	}
	$input_json = json_decode(file_get_contents("php://input"),true);
	$username = $input_json['username'];
	$password = $input_json['password'];

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
	}
	else {
		//bind the parameter
		mysqli_stmt_bind_param($stmt,"s",$username);

		//run the bind param
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		//check if the return result greater than 1
		if(mysqli_num_rows($result) > 0 ) {
			//while the result is same as the userinfo row then proceed
			if ($row = mysqli_fetch_assoc($result)) {

        		 if (password_verify($password, $row['password'])) {
        		 //start the session here
        		 		$_SESSION['username'] = $username;
						$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
						echo json_encode(array(
							"success" => true,
							"token" => $_SESSION['token'],
							"message" => "You have Log In."
						));
						exit;
        		 } else {

        		 		echo json_encode(array(
												"success" => false,
												"message" => "Invalid Username or Password"
						));
						exit;

        		 }

			}
			else{
				echo json_encode(array(
												"success" => false,
												"message" => "wrong in member!"
						));
						exit;
			}

		}
		else

   		{
			    	echo json_encode(array(
											"success" => false,
											"message" => "Invalid Username or Password on search name! $username"
					));
						exit;
   		}

	}







?>
