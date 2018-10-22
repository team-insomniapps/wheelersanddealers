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

$years = 0;
$body = "";
$trans = "";
$drive = "";
$engine = 0;
$doors = 0;
$cap = 0;
$fuel = "";
$car_age = "";

/*
foreach($_POST['transmission'] as $selected) {
echo "<p>".$selected ."</p>";
}

echo $_POST['ex_fav_color'];
echo $_POST['in_fav_color'];
echo $_POST['make'];
echo $_POST['model'];
*/
$lifestyle = $_POST['vehicle_ls'];
$age = $_POST['vehicle_vin'];
$consumption = $_POST['fuels'];
$ex_color = $_POST['ex_fav_color'];
$in_color = $_POST['in_fav_color'];


switch ($lifestyle) {
    case "Daily Commuter":
        $body = "Hatchback";
		$drive = "2 wheel-drive";
		$engine = 4;
		$doors = 5;
		$cap = 5;
        break;
	case "Workhorse":
		$body = "Utility";
		$drive = "4 wheel-drive";
		$engine = 6;
		$doors = 4;
		$cap = 5;
		$fuel = "Diesel";
		break;
	case "Family Taxi":
		$body = "Wagon";
		$drive = "2 wheel-drive";
		$engine = 6;
		$doors = 4;
		$cap = 5;
		$fuel = "Petrol";
		break;
    case "People Mover":
		$body = "Bus";
		$drive = "2 wheel-drive";
		$engine = 6;
		$doors = 4;
		$cap = 7;
		$fuel = "Diesel";
		break;
	case "Economical":
		$body = "Hatchback";
		$drive = "2 wheel-drive";
		$engine = 4;
		$doors = 5;
		$cap = 5;
		$fuel = "Electric";
		break;
	case "Speed Demon":
		$body = "Roadster";
		$drive = "2 wheel-drive";
		$engine = 8;
		$doors = 2;
		$cap = 4;
		$fuel = "Petrol";
		break;	
	case "Fun and Play":
		$body = "SUV";
		$drive = "2 wheel-drive";
		$engine = 6;
		$doors = 4;
		$cap = 5;
		$fuel = "Petrol";
		break;
	case "Normal":
		$body = "Sedan";
		$drive = "2 wheel-drive";
		$engine = 6;
		$doors = 4;
		$cap = 5;
		$fuel = "Petrol";
		break;
    default:
		
}

switch ($age) {
    case "Brand New":
        $car_age = 'New';
		$years = 2018;
        break;
	case "Fairly New":
		$car_age = "Used";
		$years = 2013;
		break;
	case "Used":
		$car_age = "Used";
		$years = 2008;
		break;
	case "Mostly Used":
		$car_age = "Used";
		$years = 1998;
		break;
	case "Rust Bucket":
		$car_age = "Used";
		$years = 1998;
		break;
	default:	
}

switch ($consumption) {
    case "Economical":
        $engine = 4;
		$fuel = "Petrol";
        break;
	case "Guzzler":
		$engine = 8;
		$fuel = "Petrol";
		break;
	case "Power Saver":
		$engine = 6;
		$fuel = "Electric";
		break;
    case "Hybrid":
		$engine = 4;
		$fuel = "Electric";
		break;
	default:

}


if(isset($_POST['submit'])){
	
	if(!empty ($_POST['transmission'])) {
		foreach($_POST['transmission'] as $selected) {}
		$trans = array($selected);
	}
	
	// check if all fields have been entered
	if( $_POST['make'] == "" ||
		$_POST['model'] == "" ||
		$_POST['vehicle_ls'] == "" ||
		$_POST['vehicle_vin'] == "" ||
		$_POST['fuels'] == "" || 
		$_POST['ex_fav_color'] == "" ||
		$_POST['in_fav_color'] == "" )
		
	{
		echo "<script>alert('Please enter all fields')</script>";
		
	}else{
		
		// if all fields are entered then proceed with connection to database 
		// connect to database
		$username = "efftwelv_andrew";
		$password = "Andrew1000";
	 	
		// variables to hold post information by form
		$makes = $_POST['make'];
		$models = $_POST['model'];
		$fuelling = $_POST['fuels'];
		
		try 
		{
			$conn = new PDO($dsn, $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			
			$query_save_pref = "INSERT INTO `preferences` (`make`,`model`, `year`, `car_condition`,
															`body`, `drive`, `engine`, 
															`doors`, `capacity`, `ex_color`, `in_color`, `transmission`) VALUES ('{$makes}', '{$models}', {$years},
															'{$car_age}', '{$body}','{$drive}',
															'{$engine}','{$doors}', '{$cap}','{$ex_color}', '{$in_color}', '{$selected}')";
			/*
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
			$query_add_car_photos = "INSERT INTO `car_photos` (`vehicle_id`, `car_description`) VALUES ('{$regos}','{$desc}')";
			
			echo '<script>alert("' . $query . '");</script>';
			*/
			// add all fields to all the tables
			$conn->beginTransaction();	
			$conn->exec($query_save_pref);
			//$conn->exec($query_add_body_types);
			//$conn->exec($query_add_car_make);
			//$conn->exec($query_add_car_model);
			//$conn->exec($query_add_car_photos);
			//$conn->exec($query_add_vehicle);
			$conn->commit();
			
			// echo "Connected successfully"; 
			echo "<script>alert('Connected successfully')</script>";
			
			// not yet in the database structure
			// {$_POST['interiorColor']}', '{$_POST['condition']}', 
			
			// database not yet used in the form
			//
			$conn->null;
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
		
		<!-- link Jquery, Bootstrap, and Popper.js -->
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
		<script>
			function selectTrans(source) {
				var checkboxes = document.querySelectorAll('input[type="checkbox"]');
				for (var i = 0; i < checkboxes.length; i++) {
					if (checkboxes[i] != source)
					checkboxes[i].checked = source.checked;
				}
			}
		</script>
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<!-- branding logo image -->
			<a class="navbar-brand" href="http://www.wheelersanddealers.efftwelve.com/index_log.php">
				<img src="images/robber-clipart-car-5.png" class="navLogo">
			</a>
			<!-- collapse navigation to hamburger(WTF) on small/mobile screens -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<!-- navigation bar -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
				<ul class="navbar-nav mr-auto mx-auto">
					<li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="#">About</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Register</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
				</ul>
				<!-- login button -->
				<div>
					<a class="btn btn-sm btn-outline-secondary" type="button" href="add.php">Login</a>
					<a href="#">Register</a>
				</div>
			</div>
			
		</nav>
		
		<div class="container">
		
			<h1>Wheelers & Dealers</h1>
			<h4>A cool subtitle</h4>
			<p>The concise description bit that says what we do</p>
			<p>My Vehicle Preferences</p>
			
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			
			<div  class="row">	
			<div class="col-sm-6">
			
				<!-- Vehicle Lifestyle --> 
				<div  class="form-group row">
					<label for="vehicle_ls" class="col-sm-4 col-form-label">Vehicle LifeStyle</label>
					<div class="col-sm-6">
						<input list="vehicle_ls" name="vehicle_ls" class="form-control">
							<datalist id="vehicle_ls">
								<script>
									document.getElementById("vehicle_ls").innerHTML = loadArray(["Daily Commuter", "Workhorse", "Family Taxi", "People Mover", "Economical","Speed Demon","Fun and Play", "Normal"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- Vehicle Vintage -->
				<div class="form-group row">
					<label for="vehicle_vin" class="col-sm-4 col-form-label">Vintage</label>
					<div class="col-sm-6">
						<input list="vehicle_vin" name="vehicle_vin" class="form-control">
							<datalist id="vehicle_vin">
								<script>
									document.getElementById("vehicle_vin").innerHTML = loadArray(["Brand New", "Fairly New", "Used", "Mostly Used", "Rust Bucket"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- Fuel Consumption -->
				<div  class="form-group row">
					<label for="fuels" class="col-sm-4 col-form-label">Fuel Consumption</label>
					<div class="col-sm-6">
						<input list="fuels" name="fuels" class="form-control">
							<datalist id="fuels">
								<script>
									document.getElementById("fuels").innerHTML = loadArray(["Economical", "Guzzler", "Power Saver", "Hybrid"]);
								</script>
							</datalist>
					</div>
				</div>
				
				
				
				
			</div>
			
			<div class="col-sm-6">
				
				
				<!-- Handling -->
				<div  class="form-group row">
					<label for="vehicle_hand" class="col-sm-4 col-form-label">Handling</label>
					<div class="col-sm-6" id="trans">
						<input type="checkbox" name="transmission[]" value="automatic">Automatic</br>
						<input type="checkbox" name="transmission[]" value="manual">Manual</br>
						<input type="checkbox" name="transmission[]" value="semi-automatic">Semi-Automatic</br>
						
						<input type="checkbox" name="transmission[]" onclick="selectTrans(this);">Select All</br>					</div>
				</div>
				
				
				<!-- vehicle_look
				<div  class="form-group row">
					<label for="vehicle_look" class="col-sm-4 col-form-label">Look and Feel</label>
					<div class="col-sm-6">
						<input type="checkbox" name="bodystyle[]" value="Sedan">Sedan</br>
						<input type="checkbox" name="bodystyle[]" value="Wagon">Wagon</br>
						<input type="checkbox" name="bodystyle[]" value="Sports">Sports</br>
						<input type="checkbox" name="bodystyle[]" value="SUV">SUV</br>
						<input type="checkbox" name="bodystyle[]" value="Ute">Ute</br>
						<input type="checkbox" name="bodystyle[]" value="Hatch">Hatch</br>
						<input type="checkbox" name="bodystyle[]" value="Pickup">Pickup</br>
						<!-- select all boxes -->
						<!-- <input type="checkbox" name="bopdystyle" id="select-all">Select All</br>
					</div>
				</div>
				-->

				<!-- exterior color -->
				<div  class="form-group row">
					<label for="ex_fav_color" class="col-sm-4 col-form-label">Exterior Color</label>
					<div class="col-sm-6">
						<input list="ex_fav_color" name="ex_fav_color" class="form-control">
							<datalist id="ex_fav_color">
								<script>
									document.getElementById("ex_fav_color").innerHTML = loadArray(["Black", "Blue", "Green", "Yellow", "Silver","Grey", "Pink", "Purple", "Orange"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- interior color -->
				<div  class="form-group row">
					<label for="in_fav_color" class="col-sm-4 col-form-label">Interior Color</label>
					<div class="col-sm-6">
						<input list="in_fav_color" name="in_fav_color" class="form-control">
							<datalist id="in_fav_color">
								<script>
									document.getElementById("in_fav_color").innerHTML = loadArray(["Black", "Blue", "Green", "Yellow", "Silver","Grey", "Pink", "Purple", "Orange"]);
								</script>
							</datalist>
					</div>
				</div>
				
				
				<!-- submit -->
				<div  class="form-group row">
					<div class="col-sm-6">
						<input type="submit" name="submit" class="form-control">
						
					</div>
				</div>
				
			</div>
			</div>
			</form>
			
		</div>	
		
		<footer class="page-footer fixed-bottom">
			<div class="container-fluid text-left">
				<a href="#">Privacy Policy</a>
				<a href="#">Contact</a>
				<a href="#">Logout</a>
			</div>
		</footer>

	</body>
</html>
