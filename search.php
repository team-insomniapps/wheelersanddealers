<?php session_start(); ?>

<?php
	$title = "Search";
	require 'php/header.php';
	require 'conn.php';
	
?>

<!doctype html>
<html lang="en">
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php require 'php/navAccess.php' ?>
	
	<div class="container">
		<h1>Search</h1>
			<hr>
		<form method="post" enctype="multipart/form-data" action="search_result.php">
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
									var bodyArray = [];
									document.getElementById("bodyStyle").innerHTML = bodyArray["bus", "hatch", "sedan", "wagon", "SUV", "people mover", "coupe", "convertable", "performance", "ute/pick-up", "cab chassis", "van"];
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
									var door = [];
									document.getElementById("doors").innerHTML = door["2", "4", "5+"];
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
									var cyc = [];
									document.getElementById("cylinders").innerHTML = cyc["2", "4", "6", "8", "10", "12+"];
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
									var cyc2 = [];
									document.getElementById("cylinders").innerHTML = cyc2["2", "4", "6", "8", "10", "12+"];
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
						<input type="submit" name="submit" value="SEARCH" class="btn btn-lg btn-secondary btn-block">
						
					</div>
				</div>
				
				<!-- create match -->
				<div  class="form-group row">
					<div class="col-sm-6">
						<input type="submit" name="create_match" value="CREATE MATCH" class="btn btn-lg btn-primary btn-block" formaction="user_match_requests.php">
					</div>
				</div>
				
			</div>
			</div>
			</form>
		</div>		
	
	<?php 
		require 'php/footer.php';
	?>
	
		
	</body>
</html>
