<?php
header('Content-Type: application/json');
require("combustionUser.php");
$user = new user;

	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	
	$loginStatus = $user->userLogin($email, $password);
	
	if($loginStatus) {
		//successful login header	
		$status = "one";
		
	}
	else {
		//rejected login header.. three because I have skip two due to facbeook and twitter logins.
		$status = "three";
	}

		
	
	$loginuser = $user -> getInfoByEmail($email,true);
		$fname = $loginuser[0]["f_name"];
		$lname = $loginuser[0]["l_name"];
		$username = $loginuser[0]["username"];
		  $output   = array(
							'status' =>  $status,
							'fname' => $fname,
							'lname' => $lname,
							'email' => $email,
							'username' => $username,
						

						);
						
						
						
				echo json_encode($output);
	
	
?>