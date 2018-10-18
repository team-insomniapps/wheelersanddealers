<?php
session_start();
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
		
		<div class="container">
		
			<h1>Wheelers & Dealers</h1>
			<h4>A cool subtitle</h4>
			<p>The concise description bit that says what we do</p>
			<p>My Matches</p>
			
		</div>	
		
		<div>
		<?php
		
		//initilize variables so I can use the data in them down the track
		$makes = "";
		$models = "";
		$years = 0;
		$car_con = "";
		$bodys = "";
		$trans = "";
		$drive = "";
		$engines = 0;
		$door = 0;
		$cap = 0;
		$ex = "";
		$incol = "";
		
	
			// database info
			$servername = "localhost";
			$dbname = "efftwelv_wheelersanddealers";
			$dsn = "mysql:host=$servername;dbname=$dbname";	
			$username = "efftwelv_andrew";
			$password = "Andrew1000";
		
		try {
			
			// connecting to the database
			$conn = $conn = new PDO($dsn, $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// selection query
			$stmt = $conn->prepare("SELECT `make`, `model`, `year`, `car_condition`, `body`,
				`transmission`, `drive`, `engine`, `doors`, `capacity`, `ex_color`, `in_color` FROM `preferences` WHERE `id` = 2"); 
			$stmt->execute();
			
			
			while($row=$stmt->fetch()){ 
			
				// grab data from the database table and store in variables
				$makes = $row['make'];
				$models = $row['model'];
				$years = $row['year'];
				$car_con = $row['car_condition'];
				$bodys = $row['body'];
				$trans = $row['transmission'];
				$drives = $row['drive'];
				$engines = $row['engine'];
				$door = $row['doors'];
				$cap = $row['capacity'];
				$ex = $row['ex_color'];
				$incol = $row['in_color'];
				
			}
			
			/*
			
			// set the resulting array to associative
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

			foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
			echo $v;
			}
			*/
		}
		catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
		}
		
	$conn = null;

		try {
			
			// connecting to the database
			$conn = $conn = new PDO($dsn, $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// selection query
			$stmt = $conn->prepare("SELECT * FROM `preferences`, `vehicle` WHERE `vehicle`.`car_make_id` = '{$makes}' AND `vehicle`.`car_exterior_color` = '{$ex}'"); 
			$stmt->execute();
			
			
			while($row=$stmt->fetch()){ 
			
				// grab data from the database table and store in variables
				$ids = $row['id'];
				$vins = $row['car_vin'];
				$years = $row['car_year'];
				$makes = $row['car_make_id'];
				$models = $row['car_model_id'];
				
				echo $ids;
				echo $vins;
				echo $years;
				echo $makes;
				echo $models;
				
			}
			
			
			
			/*
			
			// set the resulting array to associative
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

			foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
			echo $v;
			}
			*/
		}
		catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
		}
		
?> 
		
		<footer class="page-footer fixed-bottom">
			<div class="container-fluid text-left">
				<a href="#">Privacy Policy</a>
				<a href="#">Contact</a>
				<a href="#">Logout</a>
			</div>
		</footer>

	</body>
</html>
