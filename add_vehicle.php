<?php session_start(); 

	$title = "Add A vehicle";
	require 'php/header.php';
	require 'conn.php';

/*
*	php code to check if form has been submitted.
*	If true, then connect to the database and input the data.
*
*
*/


if(isset($_POST['submit'])){
	
	// check to see if an image was submitted
	if(!$_FILES['image']['size'] == 0) {
		
		// check the file size of the image
		if($_FILES['image']['size'] > 16700000){ // the maximum size of mediumblog
			echo"<script>alert('File uploaded exceeds maximum upload size')</script>";
		}
		
		// check the uploaded image type
		if(($_FILES['image']['type'] != 'image/png') && ($_FILES['image']['type'] != 'image/jpg') &&
		   ($_FILES['image']['type'] != 'image/jpeg') && ($_FILES['image']['type'] != 'image/gif')){
			echo"<script>alert('Unsupported filetype uploaded')</script>";
		}
	}
	
	// check if all fields have been entered
	// 'image' is currently the only optional field
	if( $_POST['vin'] == "" ||
		$_POST['year'] == "" || 
		$_POST['make'] == "" ||
		$_POST['model'] == "" ||
		$_POST['bodyStyle'] == "" ||	
		$_POST['transmission'] == "" ||	
		$_POST['exteriorColor'] == "" ||
		$_POST['conditions'] == "" ||
		$_POST['drivetrain'] == "" ||
		$_POST['cylinders'] == "" ||
		$_POST['mileage'] == "" ||
		$_POST['fuel'] == "" ||
		$_POST['doors'] == "" ||
		$_POST['passengerCapacity'] == "" ||
		$_POST['interiorColor'] == "" ||
		$_POST['description'] == "" ||
		$_POST['rego'] == "" ||
		$_POST['price'] == "")

	{
		echo "<script>alert('Please enter all fields')</script>";
		
	}else{
		
		// if all fields are entered then proceed with connection to database 
		// connect to database
		$username = "root";
		$password = "Andrew1000";
	 	
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
		
		
		// get Vin from database if it exists. Display error if it does
		try{
		
			$conn = mysqli_connect($servername,$username,$password,$dbname);
			$queryMakeID = "SELECT * FROM vehicle WHERE  car_vin = '{$vin}'";
			$result = mysqli_query($conn, $queryMakeID);
			
			if(!$result){
				echo "<script>alert('failed: ')</script>";
			}
			
			$id_found = 0;
			while($row = mysqli_fetch_assoc($result)){
				
				if($row['car_vin'] == $vin){
					
					$id_found = 1;	
					
					//to do error page or modal
					header("location:add_vehicle.php?error=vin");
					exit();
				}
			}

		} catch(Exception $e ){
			echo "<script>alert('Connection failed: ')</script>";
		}
		
		
		// release returned data
		mysqli_free_result($result);
									
		// close database connection
		mysqli_close($conn);
		
		// get Rego from database if it exists. Display error if it does
		try{
		
			$conn = mysqli_connect($servername,$username,$password,$dbname);
			$queryMakeID = "SELECT * FROM vehicle WHERE vehicle_id  = '{$regos}'";
			$result = mysqli_query($conn, $queryMakeID);
			
			if(!$result){
				echo "<script>alert('failed: ')</script>";
			}
			
			$id_found = 0;
			while($row = mysqli_fetch_assoc($result)){
				
				if($row['vehicle_id'] == $regos){
					
					$id_found = 1;	
					
					
					//to do error page or modal
					header("location:add_vehicle.php?error=rego");
					exit();	
				}
			}
			
		} catch(Exception $e ){
			echo "<script>alert('Connection failed: ')</script>";
		}
		
		// release returned data
		mysqli_free_result($result);
									
		// close database connection
		mysqli_close($conn);
		
		
		// get make id from database if it exists if not keep the submitted value
		try{
		
			$conn = mysqli_connect($servername,$username,$password,$dbname);
			$queryMakeID = "SELECT * FROM car_make WHERE  car_make_name = '{$make}'";
			$result = mysqli_query($conn, $queryMakeID);
			
			if(!$result){
				echo "<script>alert('failed: ')</script>";
			}
			
			$id_found = 0;
			while($row = mysqli_fetch_assoc($result)){
				
				if($row['car_make_name'] == $make){
					$id_found = 1;	
					$make = $row['id'];
				}
			}
		} catch(Exception $e ){
			echo "<script>alert('Connection failed: ')</script>";
		}
		
		// release returned data
		mysqli_free_result($result);
									
		// close database connection
		mysqli_close($conn);
			
		// get model id from database if it exists if not keep the submitted value
		try{
		
			$conn = mysqli_connect($servername,$username,$password,$dbname);
			$queryMakeID = "SELECT * FROM car_models WHERE  name = '{$model}'";
			$result = mysqli_query($conn, $queryMakeID);
			
			if(!$result){
				echo "<script>alert('failed: ')</script>";
			}
			
			$id_found = 0;
			while($row = mysqli_fetch_assoc($result)){
				
				if($row['name'] == $model){
					$id_found = 1;	
					$model = $row['id'];
				}
			}
			
		} catch(Exception $e ){
			echo "<script>alert('Connection failed: ')</script>";
		}
		
		// release returned data
		mysqli_free_result($result);
									
		// close database connection
		mysqli_close($conn);
		
		// get Bodystyle id from database if it exists if not keep the submitted value
		try{
		
			$conn = mysqli_connect($servername,$username,$password,$dbname);
			$queryMakeID = "SELECT * FROM car_body_types WHERE  name = '{$body_style}'";
			$result = mysqli_query($conn, $queryMakeID);
			
			if(!$result){
				echo "<script>alert('failed: ')</script>";
			}
			
			$id_found = 0;
			while($row = mysqli_fetch_assoc($result)){
				
				if($row['name'] == $body_style){
					$id_found = 1;	
					$body_style = $row['id'];
					
				}
			}
			
		} catch(Exception $e ){
			echo "<script>alert('Connection failed: ')</script>";
		}
		
		// release returned data
		mysqli_free_result($result);
									
		// close database connection
		mysqli_close($conn);
		
		// get Transmission type id from database if it exists if not keep the submitted value
		try{
		
			$conn = mysqli_connect($servername,$username,$password,$dbname);
			$queryMakeID = "SELECT * FROM car_transmission_types WHERE name = '{$transmission}'";
			$result = mysqli_query($conn, $queryMakeID);
			
			if(!$result){
				echo "<script>alert('failed: ')</script>";
			}
			
			$id_found = 0;
			while($row = mysqli_fetch_assoc($result)){
				
				if($row['name'] == $transmission){
					$id_found = 1;	
					$transmission = $row['id'];
				}
			}
			
		} catch(Exception $e ){
			echo "<script>alert('Connection failed: ')</script>";
		}
		
		// release returned data
		mysqli_free_result($result);
									
		// close database connection
		mysqli_close($conn);
		
		// send all information off to the database.
		try{
			
			
			$conn = mysqli_connect($servername,$username,$password,$dbname);

			// set autocommit to off 
			mysqli_autocommit($conn, FALSE);

			$user_id = $_SESSION['loginID'];
			
			mysqli_query($conn, "INSERT INTO `vehicle`(`user_id`, `car_vin`, `car_year`, `car_make_id`, 
			`car_model_id`, `car_exterior_color`, `car_new_used_condition`, `car_body_type_id`,
			`car_transmission_type_id`, `car_drive_type`, `car_engine_size`, `car_kilometers`,
			`car_fuel_type`, `car_num_doors`,`car_capacity`,`car_interior_color`, `vehicle_id`,
			`description`,`car_price`, `photo`) VALUES ('{$user_id}', '{$vin}', '{$year}',
			'{$make}', '{$model}', '{$ex_color}', '{$conditions}','{$body_style}','{$transmission}',
			'{$drivetrain}','{$cyclinders}', '{$mileage}','{$fuel}','{$doors}','{$passenger_capacity}',
			'{$in_color}','{$regos}', '{$desc}','{$price}','{$image}')");

			
			//commit transaction 
			if (!mysqli_commit($conn)) {
					echo "<script>alert('Transaction failed: ')</script>";
			}
			
		} catch(Exception $e ){
			echo "<script>alert('Connection failed: ')</script>";
		}
		
									
		// close database connection
		mysqli_close($conn);
	}
}	
	
?>


<!doctype html>
<html lang="en">
	
		
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
			$( function() {
				$( "#dialog-message" ).dialog({
					modal: true,
					buttons: {
					Ok: function() {
					$( this ).dialog( "close" );
					}
				  }
				});
				} );
		</script>
		
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php require 'php/navAccess.php' ?>
		
		<div class="container">
		
		
			<h1>Add a Vehicle</h1>
			<hr>
			
			<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			
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
				
				
				<!-- Image -->
				<div class="form-group row">
					<label for="image" class="col-sm-4 col-form-label">Image</label>
					<div class="col-sm-6">
						<input type="file" id="image" name="image">
					</div>
				</div>
				
				
				<!-- submit -->
				<div  class="form-group row">
					<div class="col-sm-6">
						<input type="submit" name="submit" value="submit"  class="form-control btn btn-primary">
						
					</div>
				</div>
				
			</div>
			</div>
			</form>
		</div>	
		
		</div>
		
		<!--  <script type = "text/javascript" src="../js/add_behaviour.js"></script> -->
		
		<!-- Modal -->
		<?php 
			require 'php/logRegmodals.php';
		?>
	
		<div id="results" name="results"></div>
	<?php 
		require 'php/footer.php';
		
		
	?>	
	</body>
</html>
