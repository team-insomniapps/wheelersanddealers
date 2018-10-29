<?php
	session_start();
	
	// database info
	$servername = "localhost";
	$dbname = "efftwelv_wheelersanddealers";
	$dsn = "mysql:host=$servername;dbname=$dbname";

	$username = "efftwelv_andrew";
	$password = "Andrew1000";
	
if(isset($_POST['create_match'])){
	// create variables for all entered fields
	if($_POST['make'] != "")
	{
		$make = $_POST['make'];
	}
	if($_POST['model'] != "")
	{
		$model = $_POST['model'];
	}
	if($_POST['bodyStyle'] != "")
	{
		$body_style = $_POST['bodyStyle'];
	}
	if($_POST['doors'] != "")
	{
		$doors = $_POST['doors'];
	}
	if($_POST['yearmin'] != "")
	{
		$yearmin = $_POST['yearmin'];
	}
	if($_POST['yearmax'] != "")
	{
		$yearmax = $_POST['yearmax'];
	}
	if($_POST['cylindersmin'] != "")
	{
		$cylindersmin = $_POST['cylindersmin'];
	}
	if($_POST['cylindersmax'] != "")
	{
		$cylindersmax = $_POST['cylindersmax'];
	}
	if($_POST['fuel'] != "")
	{
		$fuel = $_POST['fuel'];
	}
	if($_POST['transmission'] != "")
	{
		$transmission = $_POST['transmission'];
	}
	if($_POST['drivetrain'] != "")
	{
		$drivetrain = $_POST['drivetrain'];
	}
	if($_POST['mileagemin'] != "")
	{
		$mileagemin = $_POST['mileagemin'];
	}
	if($_POST['mileagemax'] != "")
	{
		$mileagemax = $_POST['mileagemax'];
	}
	if($_POST['exteriorColor'] != "")
	{
		$ex_color = $_POST['exteriorColor'];
	}
	if($_POST['conditions'] != "")
	{
		$conditions = $_POST['conditions'];
	}
	if($_POST['pricemin'] != "")
	{
		$pricemin = $_POST['pricemin'];
	}
	if($_POST['pricemax'] != "")
	{
		$pricemax = $_POST['pricemax'];
	}
	
	// connect to database	
	try 
	{
		$conn = new PDO($dsn, $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// TEMPORARY VARIABLES
		$passenger_capacity = 1;
		$user_id = 2;
		$in_color = 'Red';
		
		// TEMPORARY VARIABLE BEING USED FOR user id - WILL EVENTUALLY NEED TO COME FROM _SESSION
		// add a vehicle to the match_request table
		$query_add_match = "INSERT INTO `match_request` (`make_request`, `model_request`, `year_min_request`, `year_max_request`,
														 `exterior_color_request`, `interior_color_request`, `condition_request`, `body_type_request`,
														 `transmission_type_request`, `drive_type_request`, `engine_size_request`,
														 `max_kilometers_request`, `fuel_type_request`, `min_num_doors_request`,
														 `min_capacity_request`, `min_price_request`,`max_price_request`, `user_id`) 
								  VALUES ('{$make}',{$model}, '{$yearmin}', '{$yearmax}', '{$ex_color}', '{$in_color}', '{$conditions}',
								  '{$body_style}','{$transmission}', '{$drivetrain}', {$cylindersmax}, {$mileagemax},'{$fuel}',
									  {$doors}, '{$passenger_capacity}','{$pricemin}','{$pricemax}', '{$user_id}')";				  
									  
		// add all fields to all the tables
		$conn->beginTransaction();	
		$conn->exec($query_add_match);
		$conn->commit();

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
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/wheelers.css">
		
		<!-- link Jquery, Bootstrap, and Popper.js -->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap.min.js"></script>		
		
		<title>Wheelers & Deelers</title>
		
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->

    
		<?php include('nav.php'); ?>
			
		<div class="main">

			<h1>Your Match Requests</h1>
			
			<!-- TESTING -->
			<?php
			echo "{$make}{$model}{$yearmin}{$yearmax}{$ex_color}{$in_color}{$conditions}{$body_style}{$transmission}{$drivetrain}{$cylindersmax}{$mileagemax}{$fuel}{$doors}{$passenger_capacity}{$pricemin}{$pricemax}{$user_id}";
			?>
			
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