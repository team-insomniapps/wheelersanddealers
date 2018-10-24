<?php
if(!isset($_SESSION)){ session_start(); }

// database info
$servername = "localhost";
$dbname = "efftwelv_wheelersanddealers";
$dsn = "mysql:host=$servername;dbname=$dbname";


	
		// if all fields are entered then proceed with connection to database 
	// connect to database
	$username = "efftwelv_andrew";
	$password = "Andrew1000";
	
	
	try 
	{
		// $conn = new PDO($dsn, $username, $password);
		// set the PDO error mode to exception
		// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$conn = mysqli_connect($servername,$username,$password,$dbname);
		
	}
	catch(PDOException $e)
	{
		// echo "Connection failed: " . $e->getMessage();
		echo "<script>alert('Connection failed: ')</script>";
	} 

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/wheelers.css">
		
		<!-- link Jquery, Bootstrap, and Popper.js -->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		
		<title>Wheelers & Deelers</title>
		
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		
		<?php 
				include('nav.php'); 
				
		?>
		
		
		<div class="container">
		
			<h1>My Messages</h1>
			
			<section class="col-sm-8">
					<article class="row carShortArticle">
					<?php 
					
					// MySQL database query
						$queryRecords = "SELECT COUNT(`to_userID`) FROM `messages` ";
						$queryRecords .= "WHERE to_userID=".$_SESSION['loginID'];
						$result = mysqli_query($conn, $queryRecords);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
						
						
						echo '<section class="col-sm-12">';
						echo "<article class='results'>";
						
						while($row = mysqli_fetch_assoc($result)){
							
							echo "<h6 style='float:left';>Results: {$row['COUNT(`to_userID`)']}</h6><h6 style='text-align:right;'>Sort: <input type='text' class='' name='sort' value=' Price - Descending '</h6>";
										
						}
						
						echo "</article>";
						echo "</section>";
						
						// release returned data
						mysqli_free_result($result);
							

						// MySQL database query
						$queryID = "SELECT * FROM `messages` ";
						$queryID .= " INNER JOIN users ON messages.from_userID=users.id";
						$queryID .= " INNER JOIN vehicle ON messages.carID=vehicle.id";
						$queryID .= " WHERE to_userID=".$_SESSION['loginID'];
						
						// echo "<script>alert('$queryID')</script>";
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
						
						
						while($row = mysqli_fetch_assoc($result)){
												
							require "message_Content.php";
							
						}
					
						// release returned data
						mysqli_free_result($result);
							
						// close database connection
						mysqli_close($conn);
						 	
						
					?>
					<article>
					
				</section>
			
		</div>	
		
		
		
		<?php include('footer.php'); ?>

	</body>
</html>
