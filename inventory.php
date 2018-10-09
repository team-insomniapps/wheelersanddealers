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
		<div class="container">
			<?php include('nav.php'); ?>
			
			<div class="row">
				<!-- Search filter box area -->
				<div class="col-md-4">
					<div class="filterBox">
						<h4>Filter results:</h4>

						<div class="filterGroup">
							<div class="filter-label" data-toggle="collapse" data-target="#priceCollapse" aria-expanded="true" aria-controls="priceCollapse">Price</div>
							<div id="priceCollapse" class="collapse">
								<div class="form-group">
									<label for="priceMin">Price minimum:</label>
									<input class="form-control" type="number" id="priceMin" />
								</div>
								<div class="form-group">
									<label for="priceMax">Price maximum:</label>
									<input class="form-control" type="number" id="priceMax" />
								</div>
							</div>
						</div>

						<div class="filterGroup">
							<div class="filter-label" data-toggle="collapse" data-target="#distCollapse" aria-expanded="true" aria-controls="distCollapse">Distance</div>
							<div id="distCollapse" class="collapse">
								<div class="form-group">
									<label for="distMax">Maximum distance:</label>
									<input class="form-control" type="number" id="distMax" />
								</div>
							</div>
						</div>

						<div class="filterGroup">
							<div class="filter-label" data-toggle="collapse" data-target="#colourCollapse" aria-expanded="true" aria-controls="colourCollapse">Colour</div>
							<div id="colourCollapse" class="collapse">
								<div class="form-group">
									<label for="distMax">Colour:</label>
									<select class="form-control" multiple>
										<option value="black">Black</option>
										<option value="blue">Blue</option>
									</select>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Filter</button>
					</div>
				</div>


<!-- Leftovers, kept for category reference.
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
-->
				
				<div class="col-md-8">
					<article class="row carShortArticle">
					
					
					 <?php
						// MySQL database query
						$queryID = "SELECT *";
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
							echo '<a class="carLink" href="carPage.php">';
							echo "<article class='col-sm-10'>";
							echo "<ul class='carInfoList'>";
							echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
							echo " {$row['car_model_id']}<h3></li>";
							echo "<li><h6>$ {$row['car_price']}<h6></li>";
							echo "<li>Dealership</li>";
							echo "<li>Suburb/Town, STATE</li>";
							// echo "<li>{$row['description']}</li>";
							echo "</a>";
							echo '<a class="carLink" href="carPage.php">';
							echo "</article>";
							echo "<aside class='col-sm-2'>";
							echo '<img height=150 width=200 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
							echo "</aside>";
							echo "</a>";
							echo "</section>";
							
						}
					
						// release returned data
						mysqli_free_result($result);
							
						// close database connection
						mysqli_close($conn);
								
						
					?>
					<article>
				</div>
			</div>
			
			<?php include('footer.php'); ?>
		</div>	
	</body>
</html>
