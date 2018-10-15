<?php
	// connects to database
	$servername = "localhost";
	$dbname = "efftwelv_wheelersanddealers";
	$dsn = "mysql:host=$servername;dbname=$dbname";
	$username = "efftwelv_andrew";
	$password = "Andrew1000";
	
	try{
		
		$conn = mysqli_connect($servername,$username,$password,$dbname);
	}
	catch(PDOException $e)
	{
		// echo "Connection failed: " . $e->getMessage();
		echo "<script>alert('Connection failed: ')</script>";
	} 
	
?>
