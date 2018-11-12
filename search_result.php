<?php session_start(); ?>

<!doctype html>
<html lang="en">
<?php 
	
	$title = "Search Results";
	require 'php/header.php';
	require 'conn.php';
	
	
?>
	
	<body>

	<!-- nav bar -->
	<?php require 'php/navAccess.php' ?>
	
	<div class="container">
			
			<h1>Results</h1>
			<hr>
		
		<div class="row">
			<!-- Search filter box area -->
			<aside class="col-sm-3">					
				<div class="filterBox">
					<p>Filter results:</p>
					<p>Price</p>
						<input class="form-control" type="text" label="Price">
						<br>
						<br>
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
			
			<!-- Database results -->
			<section class="col-sm-8">
					<article class="row carShortArticle">
						
						
						<?php 
					
						//this query is just for the results in the database
						// if everything is empty then return all vehicles in database.
						// else return only those requuired
						if(isset($_POST['submit'])){
							
							
							if( $_POST['make'] == "" &&
								$_POST['model'] == "" &&
								$_POST['bodyStyle'] == "" &&
								$_POST['doors'] == "" &&
								$_POST['yearmin'] == "" &&
								$_POST['yearmax'] == "" &&
								$_POST['cylindersmin'] == "" &&
								$_POST['cylindersmax'] == "" &&
								$_POST['fuel'] == "" &&
								$_POST['transmission'] == "" &&
								$_POST['drivetrain'] == "" &&
								$_POST['mileagemin'] == "" &&
								$_POST['mileagemax'] == "" && 
								$_POST['exteriorColor'] == "" &&
								$_POST['conditions'] == "" &&
								$_POST['pricemin'] == "" &&
								$_POST['pricemax'] == "" )
								
							{
								
								
								// main query
								$queryRecords = "SELECT COUNT(`id`) FROM vehicle ";
								$queryRecords .= "WHERE 1";
								$result = mysqli_query($conn, $queryRecords);
								
								// Test query error
								if(!$result){
										die("Database query failed. ");
								}
								
								echo '<section class="col-sm-12">';
								echo "<article class='results'>";
							
								while($row = mysqli_fetch_assoc($result)){
								
								echo "<h6 style='float:left';>Results: 
									{$row['COUNT(`id`)']}</h6><h6 style='text-align:right;'>Sort:
									<input type='text' class='' name='' value=' Price - Descending '</h6>";
											
								}
							
								echo "</article>";
								echo "</section>";
								
								// release returned data
								mysqli_free_result($result);
								
								
								
							} else {
								
								
								$make = $_POST['make'];
								$model = $_POST['model'];
								$body_style = $_POST['bodyStyle'];
								$door = $_POST['doors'];
								$yearmin = $_POST['yearmin'];
								$yearmax = $_POST['yearmax'];
								$trans = $_POST['transmission'];
								$ex_Color = $_POST['exteriorColor'];
								$cyc_min = $_POST['cylindersmin'];
								$cyc_max = $_POST['cylindersmax'];
								$fuel = $_POST['fuel'];
								$drive = $_POST['drivetrain'];
								$mile_min = $_POST['mileagemin'];
								$mile_max = $_POST['mileagemax'];
								$cond = $_POST['conditions'];
								$pricemin = $_POST['pricemin'];
								$pricemax = $_POST['pricemax'];
								
								// main query
								$queryRecords = "SELECT COUNT(`id`) FROM `vehicle` WHERE 1";
								
								
								if($make != "") {
								
									$queryRecords .= " AND `car_make_id` = '{$make}' ";
								
								}
								
								if($model != "") {
								
									$queryRecords .= " AND `car_model_id` = '{$model}' ";
								
								}
								
								if($body_style != "") {
								
									$queryRecords .= " AND `car_body_type_id` = '{$body_style}' ";
								
								}

								if($door != "") {
									
									$queryRecords .= " AND  `car_num_doors` LIKE '{$door}'";
									
								}
								
								if($yearmin != "") {
									
									$queryRecords .= " AND  `car_year` >= '{$yearmin}'";
									
								}
								
								if($yearmax != "") {
									
									$queryRecords .= " AND  `car_year` <= '{$yearmax}'";
									
								}
								
								if($cyc_min != "") {
									
									$queryRecords .= " AND  `car_engine_size` >= '{$cyc_min}'";
									
								}
								
								if($cyc_max != "") {
									
									$queryRecords .= " AND  `car_engine_size` <= '{$cyc_max}'";
								}
								
								if($fuel != "") {
									
									$queryRecords .= " AND  `car_fuel_type` LIKE '{$fuel}'";
								}
								
								if($trans != "") {
									
									$queryRecords .= " AND  `car_transmission_type_id` LIKE '{$trans}'";
									
								}
								
								if($drive != "") {
									
									$queryRecords .= " AND  `car_drive_type` LIKE '{$drive}'";
									
								}
								
								if($mile_min != "") {
									
									$queryRecords .= " AND  `car_kilometers` >= '{$mile_min}'";
									
								}
								
								if($mile_max != "") {
									
									$queryRecords .= " AND  `car_kilometers` <= '{$mile_max}'";
									
								}
								
								if($ex_Color != "") {
									
									$queryRecords .= " AND  `car_exterior_color` LIKE '{$ex_Color}'";
									
								}
								
								if($cond != "") {
									
									$queryRecords .= " AND  `car_new_used_condition` LIKE '{$cond}'";
									
								}
								
								if($pricemin != "") {
									
									$queryRecords .= " AND  `car_price` >= '{$pricemin}'";
								
								}
								
								if($pricemax != "") {
									
									$queryRecords .= " AND  `car_price` <= '{$pricemax}'";
								
								}
								
								$result = mysqli_query($conn, $queryRecords);
								
								// Test query error
								if(!$result){
									die("Database query failed. ");
								}
						
								echo '<section class="col-sm-12">';
								echo "<article class='results'>";
							
								while($row = mysqli_fetch_assoc($result)){
								
								echo "<h6 style='float:left';>Results: 
									{$row['COUNT(`id`)']}</h6><h6 style='text-align:right;'>Sort:
									<input type='text' class='' name='' value=' Price - Descending '</h6>";
											
								}
							
								echo "</article>";
								echo "</section>";
								
								// release returned data
								mysqli_free_result($result);
								
							}
						}
						?>
						
						<?php
						
							// if all field are null return all vehicle information
							// else display only those needed.
							if(isset($_POST['submit'])){
							
							
							if( $_POST['make'] == "" &&
								$_POST['model'] == "" &&
								$_POST['bodyStyle'] == "" &&
								$_POST['doors'] == "" &&
								$_POST['yearmin'] == "" &&
								$_POST['yearmax'] == "" &&
								$_POST['cylindersmin'] == "" &&
								$_POST['cylindersmax'] == "" &&
								$_POST['fuel'] == "" &&
								$_POST['transmission'] == "" &&
								$_POST['drivetrain'] == "" &&
								$_POST['mileagemin'] == "" &&
								$_POST['mileagemax'] == "" && 
								$_POST['exteriorColor'] == "" &&
								$_POST['conditions'] == "" &&
								$_POST['pricemin'] == "" &&
								$_POST['pricemax'] == "" )
								
							{
								
								
								// main query
								$queryRecords = "SELECT * FROM vehicle";
								$queryRecords .= " INNER JOIN users ON vehicle.user_id=users.id";
								$result = mysqli_query($conn, $queryRecords);
								
								// Test query error
								if(!$result){
										die("Database query failed. ");
								}
								
								//echo '<section class="col-sm-12">';
								//echo "<article class='results'>";
							
								while($row = mysqli_fetch_assoc($result)){
									
									require "car_info_short.php";
									
									/*echo '<section class="row col-sm-12 carShortInfo">';
									echo '<a class="carLink" href="car_info.php">';
									echo "<article class='col-sm-6'>";
									echo "<ul class='carInfoList'>";
									echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
									echo " {$row['car_model_id']}<h3></li>";
									echo "<li><h6>$ {$row['car_price']}<h6></li>";
									echo "<li>Dealership</li>";
									echo "<li>Suburb/Town, STATE</li>";
									echo "<li>{$row['description']}</li>";
									echo "</a>";
									echo '<a class="carLink" href="carPage.php">';
									echo "</article>";
									echo "<aside class='col-sm-6'>";
									echo '<img class="carPhoto" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
									echo "</aside>";
									echo "</a>";
									echo "</section>";	*/
								}
								//echo "</article>";
								//echo "</section>";
								
								// release returned data
								mysqli_free_result($result);
								
										
								// close database connection
								mysqli_close($conn);
								
							} else {
								
						
								$make = $_POST['make'];
								$model = $_POST['model'];
								$body_style = $_POST['bodyStyle'];
								$door = $_POST['doors'];
								$yearmin = $_POST['yearmin'];
								$yearmax = $_POST['yearmax'];
								$trans = $_POST['transmission'];
								$ex_Color = $_POST['exteriorColor'];
								$cyc_min = $_POST['cylindersmin'];
								$cyc_max = $_POST['cylindersmax'];
								$fuel = $_POST['fuel'];
								$drive = $_POST['drivetrain'];
								$mile_min = $_POST['mileagemin'];
								$mile_max = $_POST['mileagemax'];
								$cond = $_POST['conditions'];
								$pricemin = $_POST['pricemin'];
								$pricemax = $_POST['pricemax'];
						
								// main query
								$queryRecords = "SELECT * FROM `vehicle` WHERE 1";
								
								
								if($make != "") {
								
									$queryRecords .= " AND `car_make_id` = '{$make}' ";
								
								}
								
								if($model != "") {
								
									$queryRecords .= " AND `car_model_id` = '{$model}' ";
								
								}
								
								if($body_style != "") {
								
									$queryRecords .= " AND `car_body_type_id` = '{$body_style}' ";
								
								}

								if($door != "") {
									
									$queryRecords .= " AND  `car_num_doors` LIKE '{$door}'";
									
								}
								
								if($yearmin != "") {
									
									$queryRecords .= " AND  `car_year` >= '{$yearmin}'";
									
								}
								
								if($yearmax != "") {
									
									$queryRecords .= " AND  `car_year` <= '{$yearmax}'";
									
								}
								
								if($cyc_min != "") {
									
									$queryRecords .= " AND  `car_engine_size` >= '{$cyc_min}'";
									
								}
								
								if($cyc_max != "") {
									
									$queryRecords .= " AND  `car_engine_size` <= '{$cyc_max}'";
								}
								
								if($fuel != "") {
									
									$queryRecords .= " AND  `car_fuel_type` LIKE '{$fuel}'";
								}
								
								if($trans != "") {
									
									$queryRecords .= " AND  `car_transmission_type_id` LIKE '{$trans}'";
									
								}
								
								if($drive != "") {
									
									$queryRecords .= " AND  `car_drive_type` LIKE '{$drive}'";
									
								}
								
								if($mile_min != "") {
									
									$queryRecords .= " AND  `car_kilometers` >= '{$mile_min}'";
									
								}
								
								if($mile_max != "") {
									
									$queryRecords .= " AND  `car_kilometers` <= '{$mile_max}'";
									
								}
								
								if($ex_Color != "") {
									
									$queryRecords .= " AND  `car_exterior_color` LIKE '{$ex_Color}'";
									
								}
								
								if($cond != "") {
									
									$queryRecords .= " AND  `car_new_used_condition` LIKE '{$cond}'";
									
								}
								
								if($pricemin != "") {
									
									$queryRecords .= " AND  `car_price` >= '{$pricemin}'";
								
								}
								
								if($pricemax != "") {
									
									$queryRecords .= " AND  `car_price` <= '{$pricemax}'";
								
								}
								
								$result = mysqli_query($conn, $queryRecords);
								
								// Test query error
								if(!$result){
									die("Database query failed. ");
								}
						
								echo '<section class="col-sm-12">';
								echo "<article class='results'>";
							
								while($row = mysqli_fetch_assoc($result)){
														
									echo '<section class="row col-sm-12 carShortInfo">';
									echo '<a class="carLink" href="carPage.php">';
									echo "<article class='col-sm-6'>";
									echo "<ul class='carInfoList'>";
									echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
									echo " {$row['car_model_id']}<h3></li>";
									echo "<li><h6>$ {$row['car_price']}<h6></li>";
									echo "<li>Dealership</li>";
									echo "<li>Suburb/Town, STATE</li>";
									echo "<li>{$row['description']}</li>";
									echo "</a>";
									echo '<a class="carLink" href="carPage.php">';
									echo "</article>";
									echo "<aside class='col-sm-6'>";
									echo '<img class="carPhoto" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
									echo "</aside>";
									echo "</a>";
									echo "</section>";	
								}
							
								echo "</article>";
								echo "</section>";
								
								// release returned data
								mysqli_free_result($result);
								
							}
						}
							
						?>
						
					</article>
				</section>
			
			
			
		
			</div>
		</div>
		<?php 
			require 'php/logRegmodals.php';
		?>
		<div id="results"></div>
	
	
	<?php 
		require 'php/footer.php';
	?>
 </body>  
</html>