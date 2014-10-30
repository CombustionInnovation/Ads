<?php
	class user {
		//Create a new user entry
		function createUser($un,$pw,$fn,$ln,$po,$em) {

			include('combustionAccount.php');

			//Gather data

			$username = $un;
			$password = md5($pw);
			$f_name = $fn;
			$l_name = $ln;
			$position = $po;
			$email = $em;
			$curDate = date('Y-m-d H:i:s', time());

			//query db

			$q = "INSERT INTO users(user_name,password,f_name,l_name,position,e_mail,last_login,created) 
			VALUES ('$username','$password','$f_name','$l_name','$position','$email','$curDate','$curDate')";

			$r = @mysqli_query($link, $q);

			

			mysqli_close($link);

			

		}
		
		
		//Login with email and password
		function userLogin($em, $pw) {
			include('combustionAccount.php');
			//Gather credentials
				$email = $em;
			//md5 encryption on password
				$password = md5($pw);
			//echo $em.$pw;
			$q = "SELECT * FROM users WHERE e_mail = '$email' AND password = '$password'";
			$r = @mysqli_query($link, $q);
			if(mysqli_num_rows($r) > 0){
				return true;
			}
			else {
				return false;
			}
			mysqli_close($link);

		}
		
		function getInfoByEmail($em,$bool) {

			include('combustionAccount.php');

			//Get email
			$email = $em;

			
			//query db
			$q = "SELECT * FROM users WHERE e_mail='$em'";
			$r = @mysqli_query($link, $q);

			//There can be only one!
			if(mysqli_num_rows($r) == 1) {

				while($row = mysqli_fetch_array($r)) {

					$results [] = array(
						'username' => $row['user_name'],
						'f_name' => $row['f_name'],
						'l_name' => $row['l_name'],
						'email' => $row['e_mail'],
						'last_login' => $row['last_login'],
					);

				}
				if($bool)
				{
					return $results;
				}
				else
				{
					return 1;
				}
			
			}

			else {

				return 0;	

			}
 
			mysqli_close($link);

		}
		
		//Retrieve all user info by username
		function getInfoByUsername($un,$bool) {

			include('combustionAccount.php');

			//Get username
			$username = $un;

			//query db
			$q = "SELECT * FROM users WHERE user_name='$username'";
			$r = @mysqli_query($link, $q);

			//There can be only one!
			if(mysqli_num_rows($r) > 0) {

				while($row = mysqli_fetch_array($r)) {

					$results[0] [] = array(

						'username' => $row['user_name'],
						'f_name' => $row['f_name'],
						'l_name' => $row['l_name'],
						'email' => $row['e_mail'],
						'last_login' => $row['last_login'],
					);

				}
				if($bool)
				{
					return $results;
				}
				else
				{
					return true;
				}

			}

			else {
				
				if($bool)
				{
					return $array = [];
				}
				else
				{
					false;
				}
			}

			mysqli_close($link);	

		}
		
		
		function doesEmailPasswordMatch($email,$password)
		{
			include('combustionAccount.php');

			//Get username
			$passwordEnc = md5($password);

			//query db
			$q = "SELECT * FROM users WHERE e_mail='$email' AND password = '$passwordEnc'";
			$r = @mysqli_query($link, $q);

			//There can be only one!
			if(mysqli_num_rows($r) > 0) {
						return true;
			}
			else
			{
						return false;
			}
			
		}
		
		
		//Change password
		function changePassword($email, $pw) {
			
			include('combustionAccount.php');
			
			
			$passwordEnc = md5($pw);
			
			$q = "UPDATE users SET password='$passwordEnc' WHERE e_mail='$email'";
			$r = @mysqli_query($link, $q);
			
		}
		
		
		function getUserByEmail($em) {
			
			include('combustionAccount.php');
			
			$email = $em;
			
			$q = "SELECT * FROM users WHERE e_mail='$email'";
			$r = @mysqli_query($link, $q);
			if(mysqli_num_rows($r) > 0) {
				while($row = mysqli_fetch_assoc($r)) {
					$results[] = array(
						"user_id" => $row['user_id'],
						"username" => $row['user_name'],
						"email" => $row['email'],
						"user_fname" => $row['f_name'],
						"user_lname" => $row['l_name'],				
					);
				}
				return $results;
			}
			else {
				return false;	
			}
		}
		
		function getInfobyUserID($user_id){
			include('combustionAccount.php');
			$q ="SELECT * FROM users WHERE user_id='$user_id'";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
					//$band = mysql_fetch_assoc($result);
					
				while($row = mysqli_fetch_array($r))
				{
						$output['results'] []  = array(
							'user_id' =>  $row['user_id'],
							'user_name' =>  $row['user_name'],
							'f_name' =>  $row['f_name'],
							'l_name' =>  $row['l_name'],
							'created' =>  $row['created'],
							'position' =>  $row['position'],	
						);
					}
			return $output;
		}
		
		function getLinks($user_id,$app_id){
			include('combustionAccount.php');
			$q ="SELECT  links.* ,permissions.perm_id,users.* FROM links JOIN permissions on links.app_id=permissions.app_id JOIN users ON permissions.user_id=users.user_id WHERE users.user_id='$user_id' AND permissions.level>=links.level AND permissions.app_id='$app_id'";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
					//$band = mysql_fetch_assoc($result);
					
				while($row = mysqli_fetch_array($r))
				{
						$output['results'] []  = array(
							'user_id' =>  $row['user_id'],
							'user_name' =>  $row['user_name'],
							'f_name' =>  $row['f_name'],
							'l_name' =>  $row['l_name'],
							'created' =>  $row['created'],
							'position' =>  $row['position'],
							'permission' =>  $row['perm_id'],
							'link' => $row['link'],
							'link_id' => $row['link_id'],
							'app_id' => $row['app_id'],
							'level' => $row['level'],
							'link_name' => $row['link_name'],
							'permission_id' => $row['perm_id'],
							
						);
					}
			return $output;
		}
		
		function getAllUSers(){
			include('combustionAccount.php');
			$q ="SELECT * FROM users";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
					//$band = mysql_fetch_assoc($result);
					
				while($row = mysqli_fetch_array($r))
				{
						$output['results'] []  = array(
							'user_id' =>  $row['user_id'],
							'user_name' =>  $row['user_name'],
							'f_name' =>  $row['f_name'],
							'l_name' =>  $row['l_name'],
							'created' =>  $row['created'],
							'position' =>  $row['position'],	
						);
					}
			return $output;
		}
		
		function doesEmailExist($email)
		{
			include('combustionAccount.php');
			$q ="SELECT * FROM users WHERE e_mail='$email'";
			$r = @mysqli_query($link, $q);
			$ttl = mysqli_num_rows($r);
				//$band = mysql_fetch_assoc($result);
				if($ttl!=0)
				{
					return true;
				}
				else
				{
					return false;
				}
		}
		
		function sendUserConfirmationEmail($email,$pass)
		{
				$to=$email;
			    $subject = 'This is your New Combustion password!';
			    $subject = 'This is your New Combustion password!';
				$message = "
				<html>

					<head>

					</head>


					<body style='background-color:#1b1b1b; font-family:'Helvetica'; font-size:19px;'>
					<div style=' background:#1b1b1b; position:relative; margin:auto; top:0px; height:700px; width:620px; top:20px;'>
						<ul style='position:relative; margin:auto;padding:0;width:90%; top:0px; color:white; list-style:none; '>
							<li style='text-align:center; width:100%'><p>Your password has been changed.</p></li>
							<li><p>New Password:'$pass'</p></li>
						</ul>
					</div>
					</body>

				</html>";
				
				$headers = 'From: no-reply@combustionSystem.com'  . "\r\n";
				$headers = 'From: "no-reply@combustionSystem.com"'. "\r\n";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: <no-reply@combustionSystem.com>' . "\r\n";
				mail($to, $subject, $message, $headers,"no-reply@combustionSystem.com");
		}
	}
?>