<?php
	session_start();
?>
<!doctype html>
<html lang="en">

<!-- Webpage creation -->
<?php 
	$title = "Home";
	require 'php/header.php';
	require 'conn.php';
?>
	
	<body>
	
	<!-- nav bar -->
	<?php require 'php/navAccess.php' ?>
	
	<!-- logged in email address -->
	<div class="container">
			<div class="jumbotron">
				<h1 class="display-4">Wheelers & Dealers</h1>
				<p class="lead">Lets make deals on your wheels</p>
				<p>Welcome to Wheelers and Dealers, the exclusive car matchmaking and exchange sevice.
				Wheelers and Dealers is an online Web application, that maintains your list of vehicles
				that you want to buy, sell or trade with other dealers or customers.</p>

				<p>If you have a vehicle that you want to sell, buy or trade. Wheelers and Dealers will put you in  our network of dealers that would like to buy your car. </p>
				<!-- <a class="btn btn-primary btn-lg" href="#" role="button">Get Started</a> -->
			</div>
			
			<div>
				<hr>
				<h2>DEALERS CHOICE<h2><h4><i>CAR OF THE WEEK</i></h4>
				<hr>
				<p></p>
				<?php
				
					$dealer_name = "";
					$dealer_loc = "";
					
					$query = "SELECT * FROM `users` WHERE `id` = 1";
					
					$result = mysqli_query($conn, $query);
					
					while($row = mysqli_fetch_assoc($result)){
					
						$dealer_name = $row['dealer_name'];
						$dealer_loc = $row['dealer_location'];
					}
				?>
			
			
				<?php
					
					$query = "SELECT * FROM `vehicle` WHERE `user_id` = 1 AND `id` = 1";
					
					$result = mysqli_query($conn, $query);
								
					
					
					echo '<section class="col-sm-12">';
					echo "<article class='results'>";
							
					while($row = mysqli_fetch_assoc($result)){
								
						
						echo "<section class='row col-sm-12 carShortInfo' onclick= location.href='vehicle_info.php?car_vin={$row['car_vin']}' >";
						//echo "<button type='button' class='btn btn-default' onclick= location.href='vehicle_match_info.php?car_vin={$row['car_vin']}' id=".htmlspecialchars($row['car_vin']).">View Vehicle</a>";
						//echo "<a class='carLink' onclick= location.href='vehicle_info.php?car_vin={$row['car_vin']}' id=".htmlspecialchars($row['car_vin']).">";
						echo "<article class='col-sm-6'>";
						echo "<ul class='carInfoList'>";
						echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
						echo " {$row['car_model_id']}<h3></li>";
						echo "<li><h6>$ {$row['car_price']}<h6></li>";
						echo "<li>Dealership: <b>{$dealer_name}</b></li>";
						echo "<li>Location: <b>{$dealer_loc}</b></li>";
						echo "<li>Description: {$row['description']}</li>";
						//echo "</a>";
						//echo '<a class="carLink" href="carPage.php">';
						echo "</article>";
						echo "<aside class='col-sm-6'>";
						echo '<img class="carPhoto" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
						echo "</aside>";
						//echo "</a>";
						echo "</section>";

											
					}
							
					echo "</article>";
					echo "</section>";
					
					
					// release returned data
					mysqli_free_result($result);
		
				?>
			
			</div>
	</div>
		
		<!-- Modal -->
		<?php 
			require 'php/logRegmodals.php';
		?>
	
		<!-- <div id="results" name="results"></div> -->
	<?php 
		require 'php/footer.php';
		
		
	?>	
	</footer>
 </body>  
</html>
