<?php 

	// posted variables
	$name = $_POST['postname'];
	$email = $_POST['postemail'];
	$phone = $_POST['postphone'];
	$passwords = $_POST['postpass'];
	$con_pass = $_POST['postconpass'];
	$dealer = $_POST['postdn'];
	$dealerloc = $_POST['postdl'];
	
	echo $name;
	echo $email;
	echo $phone;
	echo $passwords;
	echo $con_pass;
	echo $dealer;
	echo $dealerloc;

	// database info
	$servername = "localhost";
	$dbname = "Wheelersanddealers";
	$dsn = "mysql:host=$servername;dbname=$dbname";
	
	// connect to database
	$username = "efftwelv_andrew";
	$password = "Andrew1000";
	 
	if($dealer == "") {
		
		$permission = 2;
		$conn = mysqli_connect($servername,$username,$password,$dbname);
		
		// set autocommit to off 
		mysqli_autocommit($conn, FALSE);
	
		mysqli_query($conn, "INSERT INTO users(`customer_login`, `customer_email`,
		`customer_pass`,`customer_phone`, `access_level`) VALUES ('{$name}', '{$email}', '{$passwords}',
		'{$phone}', '{$permission}')");
	
		//commit transaction 
		if (!mysqli_commit($conn)) {
			echo "<script>alert('Transaction failed: ')</script>";
		}
		
	} else {
	 
		$permission = 2;
		$conn = mysqli_connect($servername,$username,$password,$dbname);
		
		// set autocommit to off 
		mysqli_autocommit($conn, FALSE);
	
		mysqli_query($conn, "INSERT INTO users(`customer_login`, `customer_email`,
		`customer_pass`,`customer_phone`, `dealer_name`, `dealer_location`, `access_level`) VALUES ('{$name}', '{$email}', '{$passwords}',
		'{$phone}', '{$dealer}', '{$dealerloc}','{$permission}')");
	
		//commit transaction 
		if (!mysqli_commit($conn)) {
			echo "<script>alert('Transaction failed: ')</script>";
		}
	}
?>
