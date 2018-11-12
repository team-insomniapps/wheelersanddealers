<?php
	session_start();
	
	$title = "Match";
	require 'php/header.php';
	
	require 'conn.php';
	

	// user pressed 'remove' button to remove match request from the database
	if(isset($_POST['remove_match']))
	{
		// remove request from match_request
		$id=$_POST['value'];
		$sql = "DELETE FROM match_request WHERE `id`='$id'";
		mysqli_query($conn, $sql);
		
		// remove any vehicles related to this request from match_removed_vehicles
		$sql = "DELETE FROM match_removed_vehicles WHERE `match_id`='$id'";
		mysqli_query($conn, $sql);
		
		// remove any vehicles related to this request from match_stored_vehicles
		$sql = "DELETE FROM match_stored_vehicles WHERE `match_id`='$id'";
		mysqli_query($conn, $sql);
	}
	
	$user_id = 6 ; //$_SESSION['loginID'];
			
	$insert_col = "INSERT INTO `match_request` (`user_id`";
	$insert_data = " VALUES ('{$user_id}'";
	
	// user was directed here by creating a match
	if(isset($_POST['create_match'])){
		// create variables for all entered fields
		if($_POST['make'] != "")
		{
			$make = $_POST['make'];
			$insert_col .= ", `make_request`";
			$insert_data .= ", '{$make}'";
		}
		if($_POST['model'] != "")
		{
			$model = $_POST['model'];
			$insert_col .= ", `model_request`";
			$insert_data .= ", '{$model}'";
		}
		if($_POST['bodyStyle'] != "")
		{
			$body_style = $_POST['bodyStyle'];
			$insert_col .= ", `body_type_request`";
			$insert_data .= ", '{$body_style}'";
		}
		if($_POST['doors'] != "")
		{
			$doors = $_POST['doors'];
			$insert_col .= ", `min_num_doors_request`";
			$insert_data .= ", {$doors}";
		}
		if($_POST['yearmin'] != "")
		{
			$yearmin = $_POST['yearmin'];
			$insert_col .= ", `year_min_request`";
			$insert_data .= ", {$yearmin}";
		}
		if($_POST['yearmax'] != "")
		{
			$yearmax = $_POST['yearmax'];
			$insert_col .= ", `year_max_request`";
			$insert_data .= ", {$yearmax}";
		}
		if($_POST['cylindersmin'] != "")
		{
			$cylindersmin = $_POST['cylindersmin'];
			$insert_col .= ", `min_cylinders_request`";
			$insert_data .= ", {$cylindersmin}";
		}
		if($_POST['cylindersmax'] != "")
		{
			$cylindersmax = $_POST['cylindersmax'];
			$insert_col .= ", `engine_size_request`";
			$insert_data .= ", {$cylindersmax}";
		}
		if($_POST['fuel'] != "")
		{
			$fuel = $_POST['fuel'];
			$insert_col .= ", `fuel_type_request`";
			$insert_data .= ", '{$fuel}'";
		}
		if($_POST['transmission'] != "")
		{
			$transmission = $_POST['transmission'];
			$insert_col .= ", `transmission_type_request`";
			$insert_data .= ", '{$transmission}'";
		}
		if($_POST['drivetrain'] != "")
		{
			$drivetrain = $_POST['drivetrain'];
			$insert_col .= ", `drive_type_request`";
			$insert_data .= ", '{$drivetrain}'";
		}
		if($_POST['mileagemin'] != "")
		{
			$mileagemin = $_POST['mileagemin'];
			$insert_col .= ", `min_kilometers_request`";
			$insert_data .= ", {$mileagemin}";
		}
		if($_POST['mileagemax'] != "")
		{
			$mileagemax = $_POST['mileagemax'];
			$insert_col .= ", `max_kilometers_request`";
			$insert_data .= ", {$mileagemax}";
		}
		if($_POST['exteriorColor'] != "")
		{
			$ex_color = $_POST['exteriorColor'];
			$insert_col .= ", `exterior_color_request`";
			$insert_data .= ", '{$ex_color}'";
		}
		if($_POST['conditions'] != "")
		{
			$conditions = $_POST['conditions'];
			$insert_col .= ", `condition_request`";
			$insert_data .= ", '{$conditions}'";
		}
		if($_POST['pricemin'] != "")
		{
			$pricemin = $_POST['pricemin'];
			$insert_col .= ", `min_price_request`";
			$insert_data .= ", {$pricemin}";
		}
		if($_POST['pricemax'] != "")
		{
			$pricemax = $_POST['pricemax'];
			$insert_col .= ", `max_price_request`";
			$insert_data .= ", {$pricemax}";
		}
		
			/*
			$insert_col .= ", `interior_color_request`";
			$insert_data .= ", '{$in_color}'";
			
			$insert_col .= ", `min_capacity_request`";
			$insert_data .= ", '{$passenger_capacity}'";
			*/
		
		$insert_col .= ") ";
		$insert_data .= ")";
		
		// connect to database
		try 
		{
			// TEMPORARY VARIABLES
			/* $passenger_capacity = '1'; 
			$user_id = '2';
			$in_color; */
		
			// TEMPORARY VARIABLE BEING USED FOR user id - WILL EVENTUALLY NEED TO COME FROM _SESSION
			// add a vehicle to the match_request table
			/* $query_add_match = "INSERT INTO `match_request` (`user_id`, `make_request`, `model_request`, `year_min_request`, `year_max_request`,
															`exterior_color_request`, `interior_color_request`, `condition_request`, `body_type_request`,
															`transmission_type_request`, `drive_type_request`, `engine_size_request`, `max_kilometers_request`,
															`fuel_type_request`, `min_num_doors_request`, `min_capacity_request`, `min_price_request`,`max_price_request`) 
								VALUES ('{$user_id}', '{$make}', '{$model}', '{$yearmin}', '{$yearmax}', '{$ex_color}', '{$in_color}', '{$conditions}',
										'{$body_style}', '{$transmission}', '{$drivetrain}','{$cylindersmax}', '{$mileagemax}','{$fuel}',
										'{$doors}', '{$passenger_capacity}','{$pricemin}','{$pricemax}')";
					 */
					 
			$query_add_match = $insert_col;
			$query_add_match .= $insert_data;
					 
			mysqli_query($conn, $query_add_match);
			// echo "Connected successfully"; 
			echo "<script>alert('Vehicle Added Successfully')</script>";
		}
		catch(PDOException $e)
		{
			// echo "Connection failed: " . $e->getMessage();
			echo "<script>alert('Connection failed')</script>";
		}
	}
?>

<!doctype html>
<html lang="en">
	<head>
		
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php require 'php/navAccess.php' ?>
			
		<div class="main">

			<h1>Your Match Requests</h1>
			
			<?php
			echo $query_add_match;
			// get users match requests from match_request table
			// TEMPORARY QUERY, THE USER ID WILL HAVE TO BE SET TO MATCH CURRENT USERS ID
			$matchRequestsID = "SELECT *";
			$matchRequestsID .= "FROM match_request ";
			$matchRequestsID .= "WHERE `user_id`='$user_id'";
			
			$matchRequests = mysqli_query($conn, $matchRequestsID);
				
			// Test query error
			if(!$matchRequests){
				die("Database query failed. ");
			}		
						
			//incrementer for modal id
			$modelNum = 0;
			
			while($requestRow = mysqli_fetch_assoc($matchRequests)){
				// put match request result into variables
				$id = $requestRow['id'];
				$make = $requestRow['make_request'];
				$model = $requestRow['model_request'];
				$body_style = $requestRow['body_type_request'];
				$door = $requestRow['min_num_doors_request'];
				$yearmin = $requestRow['year_min_request'];
				$yearmax = $requestRow['year_max_request'];
				$trans = $requestRow['transmission_type_request'];
				$ex_Color = $requestRow['exterior_color_request'];
				$fuel = $requestRow['fuel_type_request'];
				$drive = $requestRow['drive_type_request'];
				$mile_max = $requestRow['max_kilometers_request'];
				$cond = $requestRow['condition_request'];
				$pricemin = $requestRow['min_price_request'];
				$pricemax = $requestRow['max_price_request'];
				echo '<section class="row col-sm-12 carShortInfo">';
				echo '<ul id="requestInfoTable">';
					if($make != NULL) {
						echo "<li><b>Make: </b>$make</li>";
					}
					if($model != NULL) {
						echo "<li><b>Model: </b>$model</li>";
					}
					if($yearmin != NULL && $yearmin != 0) {
						echo "<li><b>Minimum Year: </b>$yearmin</li>";
					}
					if($yearmax != NULL && $yearmax != 0) {
						echo "<li><b>Maximum Year: </b>$yearmax</li>";
					}
					if($cond != NULL) {
						echo "<li><b>Condition: </b>$cond</li>";
					}
					if($mile_max != NULL && $mile_max != 0) {
						echo "<li><b>Max Kilometers: </b>$mile_max</li>";
					}
					if($ex_Color != NULL) {
						echo "<li><b>Exterior Color: </b>$ex_Color</li>";
					}
					if($body_style != NULL) {
						echo "<li><b>Body Type: </b>$body_style</li>";
					}
					if($trans != NULL) {
						echo "<li><b>Transmission: </b>$trans</li>";
					}
					if($drive != NULL) {
						echo "<li><b>Drive Type: </b>$drive</li>";
					}
					if($fuel != NULL) {
						echo "<li><b>Fuel Type: </b>$fuel</li>";
					}
					if($door != NULL && $door != 0) {
						echo "<li><b>Minimum Number of Doors: </b>$door</li>";
					}
					if($pricemin != NULL && $pricemin != 0) {
						echo "<li><b>Minimum Price: </b>$$pricemin</li>";
					}
					if($pricemax != NULL && $pricemax != 0) {
						echo "<li><b>Maximum Price: </b>$$pricemax</li>";
					}
					echo '</ul>';
					
					// button for removing match request from match_request DB
					echo '<form method="post" enctype="multipart/form-data" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>';
						echo "<input type='hidden' name='value' placeholder='Mandatory' value='{$requestRow['id']}'>";
						echo '<button type="submit" name="remove_match" class="form-control btn btn-primary">Remove Match Request</button>';
					echo '</form>';
					
					echo "</section>";
			}
						
			// release returned data
			mysqli_free_result($matchRequests);					
		?>				
			
		</div>
		
		<!-- Modal -->
		<?php require 'php/logRegmodals.php'; ?>
	
		<?php require 'php/footer.php'; ?>

	</body>
</html>