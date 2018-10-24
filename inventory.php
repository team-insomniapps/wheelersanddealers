<?php

	session_start();
/*
*	php code to check if form has been submitted.
*	If true, then connect to the database and input the data.
*
*
*/
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
		
		<!-- link Jquery, Bootstrap -->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		
		
		<title>Wheelers & Deelers</title>
		
		<script>
			
			<!-- Generating year ranges -->
			var yearRangeStr; 
			var year = 2018;
			while (year > 1919){
				yearRangeStr += '<option value="' + year + '">';
				year -= 1;
			}
		</script>	
		<script>	
			<!-- generic loading -->
			function loadArray(array){
				var arrString = "";
				for (var i=0; i < array.length; i++){
					arrString += '<option value="' + array[i] + '">';
				}
				return arrString;
			}
		
		</script>
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		
		<?php include('nav.php'); ?>
		
		
		
		<div class="main">
			<div class ="row col-sm-3">
				<a class="addCar btn btn-sm btn-outline-secondary"  href="add.php">Add Vehicle</a>
			</div>
		
		
			<div class="row">
				<!-- Search filter box area -->
				<aside class="col-sm-3">
					
					<div class="filterBox">
						<p>Filter results:</p>
						<p>Price</p>
						<input class="form-control" type="text" label="Price">
						<br>
						<br>
						<form>
						<p>Category</p>
						<input list="categories" name="categories" class="form-control" onfocus="this.value=''">
							<datalist id="categories">
								<script>
									document.getElementById("categories").innerHTML = loadArray(["Vin", "Year", "Make", "Model", "Exterior Color", "Condition", "Body Style", "Transmission", "Drivetrain", "Cylinders", "Mileage", "Fuel", "Doors", "Passenger Capacity", "Interior Color", "Rego", "Description", "Price"]);
								</script>
							</datalist>
							
							<script>
								function addCategory(){
									var cat = document.getElementById();
									cat.classList.toggle("invisible");
								}
							</script>
							</br>
						<a class="filterBtn btn btn-sm btn-outline-secondary">Filter</a>
						
						
					</div>
				</aside>
				<section class="col-sm-8">
					<article class="row carShortArticle">
					<?php 
					
					// MySQL database query
						$queryRecords = "SELECT COUNT(`id`) FROM `vehicle` ";
						$queryRecords .= "WHERE user_id=".$_SESSION['loginID'];

						$result = mysqli_query($conn, $queryRecords);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
						
						echo '<section class="col-sm-12">';
						echo "<article class='results'>";
						
						while($row = mysqli_fetch_assoc($result)){
							
							echo "<h6 style='float:left';>Results: {$row['COUNT(`id`)']}</h6><h6 style='text-align:right;'>Sort: <input type='text' class='' name='sort' value=' Price - Descending '</h6>";
										
						}
						
						echo "</article>";
						echo "</section>";
						
						// release returned data
						mysqli_free_result($result);
							

						// MySQL database query
						$queryID = "SELECT *";
						$queryID .= "FROM vehicle ";
						$queryID .= " INNER JOIN users ON vehicle.user_id=users.id ";
						if(isset($_SESSION['loginID'])){
							$queryID .= "WHERE user_id=".$_SESSION['loginID'];
						}
						// echo "<script>alert('$queryID')</script>";
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
						
						
						while($row = mysqli_fetch_assoc($result)){
												
							require "car_info_short.php";
							
						}
					
						// release returned data
						mysqli_free_result($result);
							
						// close database connection
						mysqli_close($conn);
								
						
					?>
					<article>
				</section>
			</div>
			
		</div>	
		
		<footer class="page-footer">
			<div class="footerTxt container-fluid text-left">
				<a class="footerTxt" href="#">Privacy Policy</a>
				<a class="footerTxt" href="#">Contact</a>
				<a class="footerTxt" href="#">Logout</a>
			</div>
		</footer>
		
	</body>
</html>
