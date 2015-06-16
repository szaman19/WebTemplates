<?php
#Add server information
#This could be done in a configuration file and required() later
define("DB_name", "yourDBname");
define("pass", "YourDBpassword");
define("serverName", "localhost");
define("serverUser", "yourUserName");
#Output and gateway variables 
$continue = false;
$message = '';
#Connect to database
$connection = mysqli_connect(serverName,serverUser,pass,DB_name);
#Check connection
if ($connection) {
	# code...
	//echo "Connection succesful <br/>";
	
	#die($message);
}else{
	echo mysqli_connect_error();
	$continue = true;
}
//print_r($_POST);
#Check if form was submitted
if ($_POST['firstName']&&$_POST['lastName']) {
	//echo "Post variables recieved <br/>";
	//print_r($_POST);
	# code...
	$continue = true;
}
else{
	echo "Post Variables not received \n";
	die();
}
//var_dump($continue);
if ($continue) {
	# code...
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$hash = hash('sha256', $_POST['firstName'].$_POST['email']."STUDENT");
	$options=[
	 		'cost' => 12,
	 		'salt' => $hash
	 	];
	$password = password_hash($_POST['password'],PASSWORD_BCRYPT,$options);

	if ($firstName && $lastName && $email && $password) {
		# code...
		$userInfo = "'".$firstName."','".$lastName."','".$email."','".$password."'";
		//echo($userInfo);
		$registerUser = "INSERT INTO `yourDBname`.`yourTableName`(FirstName,LastName,Email,Password)Values(".$userInfo.")";
		if (mysqli_query($connection,$registerUser)) {
			# code...
			echo "Registration complete";
		}else{
			echo " Data could not be inserted".mysqli_error($connection);
		}
		 
	}
}else{
	echo " Registration not completed";
}
//echo $message;
?>