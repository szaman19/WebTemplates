<?php
session_start();
define("DB_name", "yourDBname");
define("pass", "YourDBpassword");
define("serverName", "localhost");
define("serverUser", "yourUserName");
//Don't forget to configure your table name below;
#Output and gateway variables 
$continue = false;
$message = '';
$done = false;
$name ='';
#Connect to database
$connection = mysqli_connect(serverName,serverUser,pass,DB_name);
#Check connection
if (!$connection) {
	# code...
	echo (mysqli_connect_error());
	#die($message);
}else{
	//echo "Connection succesful \n";
	$continue = true;
}
#Check if form was submitted
if ($_POST['emailLogIn']) {
	$continue = true;
}
else{
	$continue = false;
	echo ($message."Post Variables not received \n");
}
if ($continue) {
	$email = trim($_POST['emailLogIn']);
	$password = trim($_POST['passwordLogIn']);
	$username = mysqli_real_escape_string($username);
    $password = mysqli_real_escape_string($password);
	$dbUserInfo = "SELECT FirstName,Email,Password FROM YourTableName WHERE Email ='$email'";
	$result = mysqli_query($connection,$dbUserInfo);
	if ($result) {
		$row = mysqli_fetch_array($result);
		$hash = hash('sha256', $row['FirstName'].$email."STUDENT");
		$options=[
	 		'cost' => 12,
	 		'salt' => $hash
	 		];
		$password = password_hash($_POST['passwordLogIn'],PASSWORD_BCRYPT,$options);
		$passwordCheck = $password == $row['Password'];
		if ($passwordCheck) {
			
			$done = true;
			$name = $row['0'];
			$

		}else{
			echo($message = $message."Password did not match");
		}
	}
}//else{
#		
#	}
#}
#echo($message);

	if ($done) {
		# code...
		$_SESSION['name'] = $name;
		$_SESSION['status'] = "logged";
		header("location: dashboard.php");
		exit();
	}
?>