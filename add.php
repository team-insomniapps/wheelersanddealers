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

 
if(isset($_POST['submit'])){
	
	// check if all fields have been entered
	if( $_POST['vin'] == "" ||
		$_POST['make'] == "" ||
		$_POST['model'] == "" ||
		$_POST['year'] == "" ||
		$_POST['price'] == "" ||
		$_POST['mileage'] == "" ||
		$_POST['exteriorColor'] == "" ||
		//$_POST['interiorColor'] == "" ||
		$_POST['transmission'] == "" ||
		$_POST['fuel'] == "" ||
		//$_POST['condition'] == "" ||
		$_POST['drivetrain'] == "" ||
		$_POST['cylinders'] == "" ||
		$_POST['bodyStyle'] == "" ||
		$_POST['passengerCapacity'] == "" ||
		$_POST['doors'] == "")
	{
		echo "<script>alert('Please enter all fields')</script>";
		
	}else{
		
		// if all fields are entered then proceed with connection to database 
		// connect to database
		$username = "efftwelv_andrew";
		$password = "Andrew1000";
	 	
		
		
		try 
		{
			$conn = new PDO($dsn, $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			
			$query = "INSERT INTO `vehicle`(`car_vin`, `car_make_id`, `car_model_id`, `car_year`, `car_price`, `car_kilometers`, `car_color`, `car_transmission_type_id`, `car_fuel_type`, `car_body_type_id`, `car_num_doors`, `car_engine_size`, `car_drive_type`) VALUES (";
			
			$query .= "'{$_POST['vin']}', '{$_POST['make']}', '{$_POST['model']}', '{$_POST['year']}', '{$_POST['price']}', '{$_POST['mileage']}', '{$_POST['exteriorColor']}', '{$_POST['transmission']}', '{$_POST['fuel']}', '{$_POST['bodyStyle']}', '{$_POST['doors']}', '{$_POST['cylinders']}', '{$_POST['drivetrain']}')";
				
			echo '<script>alert("' . $query . '");</script>';
				
			$conn->exec($query);
			
			// echo "Connected successfully"; 
			echo "<script>alert('Connected successfully')</script>";
			
			// not yet in the database structure
			// {$_POST['interiorColor']}', '{$_POST['condition']}', 
			
			// database not yet used in the form
			//
			
		}
		catch(PDOException $e)
		{
			// echo "Connection failed: " . $e->getMessage();
			echo "<script>alert('Connection failed: ')</script>";
		} 
	
	}
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

		

		<div class="main">
			<h1>Wheelers & Dealers</h1>
			<p>Complete the form to add your Vehicle</p>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			
			<div  class="row">	
			<div class="col-sm-6">
			
				<!-- Make -->
				<div  class="form-group row">
					<label for="vin" class="col-sm-4 col-form-label">VIN</label>
					<div class="col-sm-6">
						<input list="vin" name="vin" class="form-control">
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
						</input>
					</div>
				</div>
				
				<!-- price  -->
				<div class="form-group row">
					<label for="price" class="col-sm-4 col-form-label">Price</label>
					<div class="col-sm-6">
						<input class="form-control" id="price" name="price">
					</div>
				</div>
				
				<!-- Mileage-->
				<div class="form-group row">
					<label for="mileage" class="col-sm-4 col-form-label">Mileage</label>
					<div class="col-sm-6">
						<input id="mileage" name="mileage" class="form-control">
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
				
				
				
				
			</div>
			<div class="col-sm-6">
				
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
				
				<!-- condition -->
				<div  class="form-group row">
					<label for="condition" class="col-sm-4 col-form-label">Condition</label>
					<div class="col-sm-6">
						<input list="condition" name="condition" class="form-control">
							 <datalist id="condition">
								<script>
									document.getElementById("condition").innerHTML = loadArray(["new", "used"]);
								</script>
							 </datalist>
					</div>
				</div>
				
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
		

		
		<!-- link Jquery, Bootstrap, and Popper.js -->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

	</body>
</html>