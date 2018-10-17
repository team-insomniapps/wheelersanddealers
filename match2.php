<?php
session_start();
?>
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
/*
if(isset($_POST['submit'])){
	

	{
		echo "<script>alert('Please enter all fields')</script>";
		
	}else{
		
		// if all fields are entered then proceed with connection to database 
		// connect to database
		$username = "efftwelv_andrew";
		$password = "Andrew1000";
	 	/*
		// variables to hold post information by form
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
		$price = $_POST['price'];
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		
		try 
		{
			$conn = new PDO($dsn, $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			
			// add a vehicle to the vehicle table
			$query_add_vehicle = "INSERT INTO `vehicle` (`car_vin`, `car_year`, `car_make_id`, `car_model_id`,
														 `car_exterior_color`, `car_new_used_condition`,
														 `car_body_type_id`, `car_transmission_type_id`,
														 `car_drive_type`, `car_engine_size`, `car_kilometers`,
														 `car_fuel_type`, `car_num_doors`, `car_capacity`,
														 `car_interior_color`, `vehicle_id`,`description`, `car_price`) 
								  VALUES ('{$vin}',{$year}, '{$make}', '{$model}', '{$ex_color}', '{$conditions}',
								  '{$body_style}','{$transmission}', '{$drivetrain}', {$cyclinders}, {$mileage},'{$fuel}',
									  {$doors}, '{$passenger_capacity}','{$in_color}','{$regos}','{$desc}', {$price})"; 
			
			// add the transmission type to the car_transmission_types table
			$query_add_transmission = "INSERT INTO `car_transmission_types` (`name`) VALUES ('{$transmission}')"; 
			
			// add the body type to the car_body_types table
			$query_add_body_types = "INSERT INTO `car_body_types` (`name`) VALUES ('{$body_style}')";
			
			// add the make to the car make table
			$query_add_car_make = "INSERT INTO `car_make` (`car_make_name`) VALUES ('{$make}')";
			
			// add the model to the car model table
			$query_add_car_model = "INSERT INTO `car_models` (`car_make_id`,`name`) VALUES ('{$make}','{$model}')";
			
			// add the vehicle id to the car_photos table ** Note car_photo blob is null
			$query_add_car_photos = "INSERT INTO `car_photos` (`vehicle_id`, `car_description`, `car_photo`) VALUES ('{$regos}','{$desc}','{$image}')";
			
			// add all fields to all the tables
			$conn->beginTransaction();	
			$conn->exec($query_add_transmission);
			$conn->exec($query_add_body_types);
			$conn->exec($query_add_car_make);
			$conn->exec($query_add_car_model);
			$conn->exec($query_add_car_photos);
			$conn->exec($query_add_vehicle);
			$conn->commit();
			
			// echo "Connected successfully"; 
			echo "<script>alert('Connected successfully')</script>";
			
			// not yet in the database structure
			// {$_POST['interiorColor']}', '{$_POST['condition']}', 
			
			// database not yet used in the form
			//
			
		
		catch(PDOException $e)
		{
			// echo "Connection failed: " . $e->getMessage();
			echo "<script>alert('Connection failed')</script>";
		} 
	
	}
}	
*/	
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
			<a class="navbar-brand" href="http://www.wheelersanddealers.efftwelve.com/index_log.php">
				<img src="images/logo_red.svg" class="navLogo">
			</a>
			<!-- collapse navigation to hamburger on small/mobile screens -->
			<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			
			<!-- navigation bar -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
				<ul class="navbar-nav mr-auto mx-auto">
					<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="inventory.php">Inventory <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="#">Messages</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Account & Settings</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Help</a></li>
				</ul>
					
					
				</ul>
				<!-- login/logout button -->
				<div>
					<a class="logBtn btn btn-sm btn-outline-secondary"  href="index.php">Logout</a>
				</div>
			</div>
		</nav>
		
		
		<div class="container">
			<h1>Wheelers & Dealers</h1>
			<p>Complete the form to add your Vehicle</p>
			<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			
			<div  class="row">	
			<div class="col-sm-6">
			
				<!-- VIN -->
				<div  class="form-group row">
					<label for="vin" class="col-sm-4 col-form-label">VIN</label>
					<div class="col-sm-6">
						<input list="vin" name="vin" class="form-control">
					</div>
				</div>
				
				<!-- year-->
				<div class="form-group row">
					<label for="year" class="col-sm-4 col-form-label">Year</label>
					<div class="col-sm-6">
						<input type="number" min="1920" max="2018" list="year" name="year" class="form-control">
							<datalist id="year">
								<script>
									document.getElementById("year").innerHTML = yearRangeStr;
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- Make -->
				<div  class="form-group row">
					<label for="make" class="col-sm-4 col-form-label">Make</label>
					<div class="col-sm-6">
						<input list="make" name="make" class="form-control">
							<datalist id="make">
								<script>
									document.getElementById("make").innerHTML = loadArray(["Toyota", "BMW", "Holden", "Nissan"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- Model -->
				<div  class="form-group row">
					<label for="model" class="col-sm-4 col-form-label">Model</label>
					<div class="col-sm-6">
						<input list="model" name="model" class="form-control">
							<!-- <datalist id="model">
								<script>
									document.getElementById("model").innerHTML = loadArray([""]);
								</script>
							</datalist> -->
					</div>
				</div>
				
				<!-- exterior color -->
				<div  class="form-group row">
					<label for="exteriorColor" class="col-sm-4 col-form-label">Exterior Color</label>
					<div class="col-sm-6">
						<input list="exteriorColor" name="exteriorColor" class="form-control">
							<datalist id="exteriorColor">
								<script>
									document.getElementById("exteriorColor").innerHTML = loadArray(["Red","Yellow", "Blue"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- condition -->
				<div  class="form-group row">
					<label for="conditions" class="col-sm-4 col-form-label">Condition</label>
					<div class="col-sm-6">
						<input list="conditions" name="conditions" class="form-control">
							 <datalist id="conditions">
								<script>
									document.getElementById("conditions").innerHTML = loadArray(["new", "used"]);
								</script>
							 </datalist>
					</div>
				</div>
				
				<!-- body style -->
				<div  class="form-group row">
					<label for="bodyStyle" class="col-sm-4 col-form-label">Body Style</label>
					<div class="col-sm-6">
						<input list="bodyStyle" name="bodyStyle" class="form-control">
							<datalist id="bodyStyle">
								<script>
									document.getElementById("bodyStyle").innerHTML = loadArray(["bus", "hatch", "sedan", "wagon", "SUV", "people mover", "coupe", "convertable", "performance", "ute/pick-up", "cab chassis", "van"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- transmission -->
				<div  class="form-group row">
					<label for="transmission" class="col-sm-4 col-form-label">Transmission</label>
					<div class="col-sm-6">
						<input list="transmission" name="transmission" class="form-control">
							<datalist id="transmission">
								<script>
									document.getElementById("transmission").innerHTML = loadArray(["automatic", "manual", "CVT", "automanual"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- passenger capacity -->
				<div  class="form-group row">
					<label for="passengerCapacity" class="col-sm-4 col-form-label">Passenger Capacity</label>
					<div class="col-sm-6">
						<input list="passengerCapacity" name="passengerCapacity" class="form-control">
							<datalist id="passengerCapacity">
								<script>
									document.getElementById("passengerCapacity").innerHTML = loadArray(["1", "2", "3", "4", "5", "6", "7", "8", "10", "12+"]);
								</script>
							</datalist>
					</div>
				</div>
				
				
			</div>
			
			<div class="col-sm-6">
				
				<!-- drivetrain -->
				<div  class="form-group row">
					<label for="drivetrain" class="col-sm-4 col-form-label">Drivetrain</label>
					<div class="col-sm-6">
						<input list="drivetrain" name="drivetrain" class="form-control">
							<datalist id="drivetrain">
								<script>
									document.getElementById("drivetrain").innerHTML = loadArray(["2 wheel-drive", "4 wheel-drive", "rear wheel-drive", "front wheel-drive", "all wheel-drive"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- Cylinders -->
				<div  class="form-group row">
					<label for="cylinders" class="col-sm-4 col-form-label">Cylinders</label>
					<div class="col-sm-6">
						<input list="cylinders" name="cylinders" class="form-control">
							<datalist id="cylinders">
								<script>
									document.getElementById("cylinders").innerHTML = loadArray(["2", "4", "6", "8", "10", "12+"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- Mileage-->
				<div class="form-group row">
					<label for="mileage" class="col-sm-4 col-form-label">Mileage</label>
					<div class="col-sm-6">
						<input id="mileage" name="mileage" class="form-control">
					</div>
				</div>
				
				<!-- fuel -->
				<div  class="form-group row">
					<label for="fuel" class="col-sm-4 col-form-label">Fuel</label>
					<div class="col-sm-6">
						<input list="fuel" name="fuel" class="form-control">
							<datalist id="fuel">
								<script>
									document.getElementById("fuel").innerHTML = loadArray(["gasoline", "diesel", "electric", "hybrid"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- doors -->
				<div  class="form-group row">
					<label for="doors" class="col-sm-4 col-form-label">Doors</label>
					<div class="col-sm-6">
						<input list="doors" name="doors" class="form-control">
							<datalist id="doors">
								<script>
									document.getElementById("doors").innerHTML = loadArray(["2", "4", "5+"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- interior color -->
				<div  class="form-group row">
					<label for="interiorColor" class="col-sm-4 col-form-label">Interior Color</label>
					<div class="col-sm-6">
						<input list="interiorColor" name="interiorColor" class="form-control">
							<datalist id="interiorColor">
								<script>
									document.getElementById("interiorColor").innerHTML = loadArray(["Red","Yellow", "Blue"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- Rego -->
				<div class="form-group row">
					<label for="rego" class="col-sm-4 col-form-label">Registration Number</label>
					<div class="col-sm-6">
						<input id="rego" name="rego" class="form-control">
					</div>
				</div>
				
				
				<!-- price  -->
				<div class="form-group row">
					<label for="price" class="col-sm-4 col-form-label">Price</label>
					<div class="col-sm-6">
						<input class="form-control" id="price" name="price">
					</div>
				</div>
				
				
				<!-- submit -->
				<div  class="form-group row">
					<div class="col-sm-6">
						<input type="submit" name="submit" value="submit" class="form-control">
						
					</div>
				</div>
				
			</div>
			</div>
			</form>
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
