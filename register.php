<?php
 
	require 'conn.php';
	

	if(isset($_POST['submit'])){

	$username = $_POST['uid'];
	$password = $_POST['pwd'];
	$first = $_POST['fname'];
	$last = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$dealer = $_POST['dname'];
	$dealer_location = $_POST['location'];


	}else {

		header("Location:testlogin.php");
		exit();
	}

	if(empty($username) || 
		empty($password) || 
		empty($first) || 
		empty($last) || 
		empty($email) ||
		empty($phone)) {
	
		header("Location:testlogin.php");
		exit();
	} else {

		if(empty($dealer) || empty($dealer_location)){

				$permission = 2;
				$query_add_user = "INSERT INTO `users` (`customer_fname`, `customer_lname`, `customer_email`, 
								`customer_login`, `customer_pass`,`customer_phone`, `access_level`) 
								VALUES('{$first}','{$last}','{$email}','{$password}','{$username}','{$phone}', '{$permission}')";
				mysqli_query($conn, $query_add_user);
				header("Location:testlogin.php?=success");
				exit();

		}
		
		
	}

	echo $username;
	echo $password;
	echo $first;
	echo $last;
	echo $email;
	echo $phone;
	echo $dealer;
	echo $dealer_location;



?>

