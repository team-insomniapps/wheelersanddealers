<?php
session_start();

	$_SESSION['loginID'] = $_POST['uid'];
	require "index.php";

 /* 
	require 'conn.php';
	

	if(isset($_POST['submit'])){

	$username = $_POST['uid'];
	$password = $_POST['pwd'];
	
	if(empty($username) || 
		empty($password)){

		header("Location:testlogin.php?=loginerror");
		exit();

	}else {
		
		$query_login = "SELECT * FROM `users` WHERE `customer_login` = '{$username}'";
		$result = mysqli_query($conn, $query_login);

		// Test query error
		if(!$result){
				die("Database query failed. ");
		}

		

		$result_check = mysqli_num_rows($result);
		
		
		if($result_check < 1){
		
		header("Location:testlogin.php?=loginerror");
		exit();
		

		} else {

			if($row = mysqli_fetch_assoc($result)) {

				
			}

		}

		
		header("Location:testlogin.php?=success");
		echo "You are now Logged in";
		$_SESSION['login'] = 'true';
		exit();
	}

} else {
	
		header("Location:testlogin.php?=loginerror");
		exit();
}
 */

?>