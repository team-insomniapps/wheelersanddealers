<?php
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
		
	/* // variables to hold post information by form
	$vin = $_POST['vin'];
	$year = $_POST['year'];
	$make = $_POST['make'];
	$model = $_POST['model'];
	$ex_color = $_POST['exteriorColor'];
	$conditions = $_POST['conditions'];
	$body_style = $_POST['bodyStyle'];
	$transmission = $_POST['transmission'];
	$drivetrain = $_POST['drivetrain'];
	$cyclinders = $_POST['cylinders'];
	$mileage = $_POST['mileage'];
	$fuel = $_POST['fuel'];
	$doors = $_POST['doors'];
	$passenger_capacity = $_POST['passengerCapacity'];
	$in_color = $_POST['interiorColor'];
	$regos = $_POST['rego'];
	$desc = $_POST['description'];
	$price = $_POST['price']; */
	
	try 
	{
		// $conn = new PDO($dsn, $username, $password);
		// set the PDO error mode to exception
		// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$conn = mysqli_connect($servername,$username,$password,$dbname);
		
		//$conn = new PDO($dsn, $username, $password);
		
		// echo "<script>alert('Connection Success: ')</script>";
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
		<nav class="navbar navbar-expand-lg">
			<!-- branding logo image -->
			<a class="navbar-brand" href="#">
				<img src="images/logo_uncoloured.svg" class="navLogo">
			</a>
			<!-- collapse navigation to hamburger on small/mobile screens -->
			<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<!-- navigation bar -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
				<ul class="navbar-nav mr-auto mx-auto">
					<li class="nav-item"><a class="nav-link" href="index_log.php">Home</a></li>
					<li class="nav-item active"><a class="nav-link" href="inventory.php">Inventory <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="add.php">Add</a></li>
					<!-- <li class="nav-item"><a class="nav-link" href="#">Messages</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Account & Settings</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Help</a></li>
					-->
					
				</ul>
					
					
				</ul>
				<!-- login/logout button -->
				<div>
					<a class="logBtn btn btn-sm btn-outline-secondary"  href="index.php">Logout</a>
				</div>
			</div>
		</nav>
		
		<div class="main">
			<div class="row">
				<!-- Search filter box area -->
				<aside class="col-sm-4">
					<div class="filterBox">
						<p>Filter results:</p>
						<p>Price</p>
						<input type="text" label="Price">
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
							
						<a type="button" label="add" id="addCategory" onclick="addCategory();">Add</a>
						
						<div id="Year" class="invisible">
							Cat
						</div>
					</div>
				</aside>
				<section class="col-sm-8">
					<article class="row carShortArticle">
					
					
					 <?php
						// MySQL database query
						$queryID = "SELECT * ";
						$queryID .= "FROM vehicle ";
						$queryID .= "WHERE 1";
						// echo "<script>alert('$queryID')</script>";
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
					
						while($row = mysqli_fetch_assoc($result)){
							echo '<section class="row col-sm-12 carShortInfo">';
							echo "<article class='col-sm-10'>";
							echo "<ul class='carInfoList'>";
							echo "<li><h4>{$row['car_make_id']}";
							echo " {$row['car_model_id']}<h3></li>";
							echo "<li><h6>$ {$row['car_price']}<h6></li>";
							echo "<li>Dealership</li>";
							echo "<li>Suburb/Town, STATE</li>";
							echo "<li>{$row['description']}</li>";
							echo '<a class="carLink" href="carPage.php">';
							echo "View";
							echo "</a>";
							echo "</article>";
							echo "<aside class='col-sm-2'>";
							echo "	<img class='carPhoto' src='images/Placeholder.png'>";
							echo "</aside>";
							echo "</section>";
							
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
