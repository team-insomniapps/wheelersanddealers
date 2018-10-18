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
		<div class="container">
			<?php include('nav.php'); ?>
		
			<h1>Pages</h1>
			<p><a href="vehicle_info.php">vehicle_info.php</a></p>
			<p><a href="vehicle_match_info.php">vehicle_match_info.php</a></p>
			<p><a href="inventory.php">inventory.php</a></p>
			<p><a href="index.php">index.php</a></p>
			<p><a href="vehicle_info_test.php">vehicle_info_test.php</a></p>
			<p><a href="testlogin.php">testlogin.php</a></p>
			<p><a href="search_results.php">search_results.php</a></p>
			<p><a href="search.php">search.php</a></p>
			<p><a href="preferences.php">preferences.php</a></p>
			<p><a href="match_test.php">match_test.php</a></p>
			<p><a href="match.php">match.php</a></p>
			<p><a href="add.php">add.php</a></p>
			<p><a href="testlogin.php">testlogin.php</a></p>
			
			
			
			<?php include('footer.php'); ?>
		</div>
	</body>

</html>
