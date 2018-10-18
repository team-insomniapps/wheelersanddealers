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


if((isset($_POST['submit'])))
{
	require "addPhpCode.php";
	
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

    	<!-- Custom stylesheet -->
    <link href="my_add.css" type="text/css" rel=stylesheet>

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
					<li class="nav-item active"><a class="nav-link" href="index_log.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="inventory.php">Inventory <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="#">Messages</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Account & Settings</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Help</a></li>
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
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


			<div  class="row">
			<div class="col-sm-6">

				<!-- VIN -->
				<div  class="form-group row">
					<label for="vin" class="col-sm-4 col-form-label">VIN</label>
					<div class="col-sm-6">
						<input list="vin" name="vin" placeholder="Mandatory" id="inputVIN" class="form-control mandatory" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['vin']);} ?>"	>
						
						
					</div>
				</div>

				<!-- year-->
				<div class="form-group row">
					<label for="year" class="col-sm-4 col-form-label">Year</label>
					<div class="col-sm-6">
						<input type="number" min="1920" max="2018" list="year" name="year" id="inputYear" class="form-control"  value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['year']);} ?>" mandatory>
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
						<input list="make" name="make" id="inputMake" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['make']);} ?>">
							<datalist id="make">
								<script>
									document.getElementById("make").innerHTML = loadArray(["Toyota", "BMW", "Holden", "Nissan"]);
								</script>
							</datalist>
					</div>
				</div>

        <div class = "RequestAddVehiclePrompt" id = addMake style="display: none">
          <!-- css will need visibility:hidden by default -->
        </div>

        <!-- Model -->
				<div  class="form-group row">
					<label for="model" class="col-sm-4 col-form-label">Model</label>
					<div class="col-sm-6">
						<input list="model" name="model" id = "inputModel" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['model']);} ?>">
							<datalist id="model">
								<script>
									document.getElementById("model").innerHTML = loadArray(["test1","test2"]);
								</script>
							</datalist>
					</div>
				</div>

        <div class = "RequestAddVehiclePrompt" id = addModel style="visibility: none">
          <!-- css will need visibility:hidden by default -->
        </div>

				<!-- exterior color -->
				<div  class="form-group row">
					<label for="exteriorColor" class="col-sm-4 col-form-label">Exterior Color</label>
					<div class="col-sm-6">
						<input list="exteriorColor" name="exteriorColor" id="inputExteriorColor" class="form-control"  value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['exteriorColor']);} ?>"	>
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
						<input list="conditions" name="conditions" id="inputCondition" class="form-control"  value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['conditions']);} ?>">
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
						<input list="bodyStyle" name="bodyStyle" id="inputBodyStyle" class="form-control"  value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['bodyStyle']);} ?>">
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
						<input list="transmission" name="transmission" id="inputTransmission" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['transmission']);} ?>">
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
						<input list="passengerCapacity" name="passengerCapacity" id="inputPassengerCapacity" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['passengerCapacity']);}?>">
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
						<input list="drivetrain" name="drivetrain" id="inputDriveTrain" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['drivetrain']);} ?>">
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
						<input list="cylinders" name="cylinders" id="inputCylinders" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['cylinders']);} ?>">
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
						<input id="mileage" name="mileage" class="form-control mandatory" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['mileage']);} ?>">
					</div>
				</div>

        <div class = "clearPrompt" id = "clearMileagePrompt" style="display: none">
        </div>

				<!-- fuel -->
				<div  class="form-group row">
					<label for="fuel" class="col-sm-4 col-form-label">Fuel</label>
					<div class="col-sm-6">
						<input list="fuel" name="fuel" id="inputFuel" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['fuel']);} ?>">
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
						<input list="doors" name="doors" id="inputDoors" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['doors']);} ?>">
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
						<input list="interiorColor" name="interiorColor" id="inputInteriorColor" class="form-control" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['interiorColor']);} ?>">
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
						<input id="rego" name="rego" class="form-control mandatory" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['rego']);} ?>">
					</div>
				</div>


				<!-- Description -->
				<div class="form-group row">
					<label for="price" class="col-sm-4 col-form-label">Description</label>
					<div class="col-sm-6">
						<input class="form-control" id="description" name="description" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['description']);} ?>">
					</div>
				</div>


				<!-- price  -->
				<div class="form-group row">
					<label for="price" class="col-sm-4 col-form-label">Price</label>
					<div class="col-sm-6">
						<input class="form-control" id="price" name="price" value="<?php if(isset($_POST['submit'])){ echo htmlspecialchars($_POST['price']);} ?>"	>
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

    <script type = "text/javascript" src="add_behaviour.js"></script>

  </body>
</html>
