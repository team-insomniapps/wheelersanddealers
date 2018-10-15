<?php

// database information and connection 
// might need to separate this later

$servername = "localhost";
$dbname = "efftwelv_wheelersanddealers";
$dsn = "mysql:host=$servername;dbname=$dbname";

$username = "efftwelv_andrew";
$password = "Andrew1000";

$conn = mysqli_connect($servername,$username,$password,$dbname);		

/*
<?php
							
							// Search database for all distinct entries of car makes
							$queryRecords = "SELECT DISTINCT `car_make_id` FROM `vehicle` WHERE `car_make_id` = `car_make_id`";
							$result = mysqli_query($conn, $queryRecords);
				
							// Store in arrary
							$make_array = array();
							
							// Test query error
							if(!$result){ die("Database query failed. "); }
						
							// create index for while loop
							$index = 0;
							
							// search each row of the results and store in an array 
							// add a dropdown box to the form with the database entries
							while($row = mysqli_fetch_assoc($result)){
								
								if($index == 0){
									
									$make_array[$index] = $row;
									echo "<option></option><option value=".$make_array[$index]['car_make_id'].">".$make_array[$index]['car_make_id']."</option>";
								} else {
									
								
									$make_array[$index] = $row;
									echo "<option value=".$make_array[$index]['car_make_id'].">".$make_array[$index]['car_make_id']."</option>";
								}
								
								$index = $index + 1;
							}
							
							?>
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
		
		<title>Wheelers & Deelers - Search</title>
		
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
	</div>
		
	<div class="container">
		<h1>Wheelers & Dealers</h1>
		<p>Search for a Vehicle</p>
			
		<form method="post" enctype="multipart/form-data" action="search_results.php">
			<div  class="row">	
				<div class="col-sm-6">

				<!-- Make -->
				<div  class="form-group row">
					<label for="make" class="col-sm-4 col-form-label">Make</label>
						<div class="col-sm-6">
							<input list="make" name="make" class="form-control">
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
				
				<!-- year -->
				<div class="form-group row">
					<label for="yearmin" class="col-sm-4 col-form-label">Year Min</label>
					<div class="col-sm-6">
						<input type="number" min="1920" max="2018" list="year" name="yearmin" class="form-control">
							<datalist id="yearmin">
								<script>
									document.getElementById("yearmin").innerHTML = yearRangeStr;
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- year -->
				<div class="form-group row">
					<label for="yearmax" class="col-sm-4 col-form-label">Year Max</label>
					<div class="col-sm-6">
						<input type="number" min="1920" max="2018" list="year" name="yearmax" class="form-control">
							<datalist id="yearmax">
								<script>
									document.getElementById("yearmax").innerHTML = yearRangeStr;
								</script>
							</datalist>
					</div>
				</div>

				<!-- Cylinders -->
				<div  class="form-group row">
					<label for="cylindersmin" class="col-sm-4 col-form-label">Cylinders Minimum</label>
					<div class="col-sm-6">
						<input list="cylindersmin" name="cylindersmin" class="form-control">
							<datalist id="cylindersmin">
								<script>
									document.getElementById("cylinders").innerHTML = loadArray(["2", "4", "6", "8", "10", "12+"]);
								</script>
							</datalist>
					</div>
				</div>
				
				<!-- Cylinders -->
				<div  class="form-group row">
					<label for="cylindersmax" class="col-sm-4 col-form-label">Cylinders Maximum</label>
					<div class="col-sm-6">
						<input list="cylindersmax" name="cylindersmax" class="form-control">
							<datalist id="cylindersmax">
								<script>
									document.getElementById("cylinders").innerHTML = loadArray(["2", "4", "6", "8", "10", "12+"]);
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
				
				<!-- Mileage-->
				<div class="form-group row">
					<label for="mileagemin" class="col-sm-4 col-form-label">Mileage Min - km</label>
					<div class="col-sm-6">
						<input id="mileagemin" name="mileagemin" class="form-control">
					</div>
				</div>
				
				<!-- Mileage-->
				<div class="form-group row">
					<label for="mileagemax" class="col-sm-4 col-form-label">Mileage Max - km</label>
					<div class="col-sm-6">
						<input id="mileagemax" name="mileagemax" class="form-control">
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

				<!-- price -->
				<div class="form-group row">
					<label for="pricemin" class="col-sm-4 col-form-label">Price Min - $AUD</label>
					<div class="col-sm-6">
						<input  id="pricemin" name="pricemin" class="form-control">
					</div>
				</div> 
				
				<!-- price -->
				<div class="form-group row">
					<label for="pricemax" class="col-sm-4 col-form-label">Price Max - $AUD</label>
					<div class="col-sm-6">
						<input  id="pricemax" name="pricemax" class="form-control">
					</div>
				</div> 

				
				<!-- submit -->
				<div  class="form-group row">
					<div class="col-sm-6">
						<input type="submit" name="submit" value="SEARCH" class="form-control">
						
					</div>
				</div>
				
			</div>
			</div>
			</form>
		</div>		
	
		<!-- link Jquery, Bootstrap, and Popper.js -->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

	<footer class="page-footer">
			<div class="footerTxt container-fluid text-left">
				<a class="footerTxt" href="#">Privacy Policy</a>
				<a class="footerTxt" href="#">Contact</a>
				<a class="footerTxt" href="#">Logout</a>
			</div>
		</footer>
		
	</body>
</html>
