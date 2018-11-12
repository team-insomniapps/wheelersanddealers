<?php
	session_start();

$title = "Inventory";
	
	
	require 'php/header.php';
	require 'conn.php';

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
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php require 'php/navAccess.php' ?>
		
		<div class="container">
		
		<h1>Inventory</h1>
			<hr>
		
			<div class ="row col-sm-3">
				<a class="addCar btn btn-primary"  href="add_vehicle.php">Add Vehicle</a>
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
						<button class="btn btn-secondary btn-sm">Filter</a>
						
						
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

