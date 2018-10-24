<?php
if(!isset($_SESSION)){ session_start(); }
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
		
		<?php 
				include('nav.php'); 
				
		?>
		
		
		<div class="container">
		
			<h1>Wheelers & Dealers</h1>
			<h4>Lets make deals on your wheels</h4>
			<p>Welcome to Wheelers and Dealers, the exclusive car matchmaking and exchange sevice.
			Wheelers and Dealers is an online Web application, that maintains your list of vehicles
			that you want to buy, sell or trade with other dealers or customers.</p>
			
			<p><img class="col-sm-12" src="images/mazda.jpg"/></p>
			
			
			<p>If you have a vehicle that you want to sell, buy or trade. Wheelers and Dealers will put you in 
			our network of dealers that would like to buy your car. </p>
			
			
			<button>Get Started</button>
			
		</div>	
		
		<?php include('footer.php'); ?>

	</body>
</html>
