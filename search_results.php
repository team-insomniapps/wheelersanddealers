<?php
	session_start();

	require 'conn.php';
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

		<title>Wheelers & Deelers - Search Results</title>
		
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php
			require 'nav.php';
		?>
		
		<div class="main">
			<div class ="row col-sm-3">
				<a class="addCar btn btn-sm btn-outline-secondary"  href="add.php">Add Vehicle</a>
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
						<a class="filterBtn btn btn-sm btn-outline-secondary">Filter</a>
						
						
					</div>
				</aside>
				<section class="col-sm-8">
					<article class="row carShortArticle">
						<?php 
					
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
								$queryRecords = "SELECT COUNT(`id`) FROM `vehicle` WHERE 1";
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
								
								
								// MySQL database query
								$queryID = "SELECT *";
								$queryID .= "FROM vehicle ";
								
								// echo "<script>alert('$queryID')</script>";
								
								$result = mysqli_query($conn, $queryID);
								
								// Test query error
								if(!$result){
										die("Database query failed. ");
								}
								
								
								
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
																
							}else{
							
								// Just created variables to troulbe shoot
								// can remove them later
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
								
								// MySQL database query
								$queryID = "SELECT *";
								$queryID .= "FROM vehicle WHERE 1";
								
								if($make != "") {
									
									$queryID .= " AND  `car_make_id` LIKE '{$make}'";
									
								}
								
								if($model != "") {
									
									$queryID .= " AND  `car_model_id` LIKE '{$model}'";
									
								}
								
								if($body_style != "") {
									
									$queryID .= " AND  `car_body_type_id` LIKE '{$body_style}'";
									
								}
								
								if($door != "") {
									
									$queryID .= " AND  `car_num_doors` LIKE '{$door}'";
									
								}
								
								if($yearmin != "") {
									
									$queryID .= " AND  `car_year` >= '{$yearmin}'";
									
								}
								
								if($yearmax != "") {
									
									$queryID .= " AND  `car_year` <= '{$yearmax}'";
									
								}
								
								if($cyc_min != "") {
									
									$queryID .= " AND  `car_engine_size` >= '{$cyc_min}'";
									
								}
								
								if($cyc_max != "") {
									
									$queryID .= " AND  `car_engine_size` <= '{$cyc_max}'";
								}
								
								if($fuel != "") {
									
									$queryID .= " AND  `car_fuel_type` LIKE '{$fuel}'";
								}
								
								if($trans != "") {
									
									$queryID .= " AND  `car_transmission_type_id` LIKE '{$trans}'";
									
								}
								
								if($drive != "") {
									
									$queryID .= " AND  `car_drive_type` LIKE '{$drive}'";
									
								}
								
								if($mile_min != "") {
									
									$queryID .= " AND  `car_kilometers` >= '{$mile_min}'";
									
								}
								
								if($mile_max != "") {
									
									$queryID .= " AND  `car_kilometers` <= '{$mile_max}'";
									
								}
								
								if($ex_Color != "") {
									
									$queryID .= " AND  `car_exterior_color` LIKE '{$ex_Color}'";
									
								}
								
								if($cond != "") {
									
									$queryID .= " AND  `car_new_used_condition` LIKE '{$cond}'";
									
								}
								
								if($pricemin != "") {
									
									$queryID .= " AND  `car_price` >= '{$pricemin}'";
								
								}
								
								if($pricemax != "") {
									
									$queryID .= " AND  `car_price` <= '{$pricemax}'";
								
								}
		
								$result = mysqli_query($conn, $queryID);
								
								// Test query error
								if(!$result){
										die("Database query failed. ");
								}
								
								
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
						
							}
							
							// release returned data
							mysqli_free_result($result);
									
							// close database connection
							mysqli_close($conn);
						}
					?>
					
					
					<article>
				</section>
			</div>
			
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
