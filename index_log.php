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
		
		<!-- navigation bar -->
		<?php include('nav.php'); ?>

		
		<div class="container">
		
			<h1>Wheelers & Dealers</h1>
			<h4>A cool subtitle</h4>
			<p>The concise description bit that says what we do</p>
			<a  class="btn btn-sm btn-outline-secondary" type="button" href="add.php">Get Started</a>
			
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
