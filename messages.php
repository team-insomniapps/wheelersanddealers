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
	
	<?php
		$title = "Messages";
		include "head.php"; ?>
	
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		
		<?php 
				include('nav.php'); 
				
		?>
		
		
		<div class="container">
		
			<h1>My Messages</h1>
			
			<section class="col-sm-12">
					<!-- <article class="row carShortArticle col-sm-12"> -->
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
							
							echo "<h6 style='float:left'>Results: {$row['COUNT(`to_userID`)']}</h6>";
							
							/*
							<h6 style='text-align:right;'>Sort: <input type='text' class='' name='sort' value=' Price - Descending '</h6>";
							*/			
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
						$queryID .= " OR from_userID=".$_SESSION['loginID'];
						$queryID .= " ORDER BY parentID, date ASC";
						// echo "<script>alert('$queryID')</script>";
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
						
						echo "<div>";
						//echo "<section class='row col-sm-12 carShortInfo' >";

						$pID = null;
						while($row = mysqli_fetch_assoc($result)){
							
							
							if($row['parentID'] == $row['message_id'] and $pID != null){
								
								echo "</article>";
								echo "</section>";
								echo "<section class='row col-sm-12 carShortInfo' >";
								
								require "message_Content.php";
								$pID = $row['parentID'];
								echo "<article class='col-sm-6'>";

							}
							else if($row['parentID'] == $row['message_id'] and $pID == null){
								
								echo "<section class='row col-sm-12 carShortInfo' >";
								require "message_Content.php";
								$pID = $row['parentID'];
								echo "<article class='col-sm-6'>";
							}
							
							
							if($row['from_userID'] == $_SESSION['loginID'])
							{
								echo "<p class='msgSeller'><sub>{$row['customer_fname']} {$row['customer_lname']}</sub><br>";
								echo "{$row['message']}</p>";
								
							}else{
								echo "<p class='msgBuyer'><sub>{$row['customer_fname']} {$row['customer_lname']}</sub><br>";
								echo " {$row['message']}</p>";
							}
							
							//require "message_Content.php";
							
						}
					echo "</div>";
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
