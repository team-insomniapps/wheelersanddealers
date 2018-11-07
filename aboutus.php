<?php session_start(); ?>
<!doctype html>
<html lang="en">
<?php 
	$title = "About Us";
	
	require 'php/header.php';
	require 'conn.php';
	
?>
	<body>	
	
	<!-- nav bar -->
	<?php require 'php/navAccess.php' ?>
	
	
	<div class="container">
			<div>
				<h4>About Us</h4><hr>
				<h1>Wheelers & Dealers</h1>
				<p><h5>Our Mission<hr id="under"></h5><p>
				<p>Wheelers and Dealers provide an online appilcation platform for car dealers for vehicle matchmaking and to trade, purchase, and exchange vehicles</p>
				<p><h5>Our Vision<hr id="under2"></h5><p>
				<p><h5>Our Story<hr id="under3"></h5><p>
				<p><h5>Our Team<hr id="under4"></h5><p>
			</div>
	</div>
		<!-- Modal -->
		<?php 
		require 'php/logRegmodals.php';
		?>
				
		<div id="results"></div>
	<?php 
		require 'php/footer.php';
	?>
	</div>
 </body>  
</html>
