<?php
	// database info
	$servername = "localhost";
	$dbname = "efftwelv_wheelersanddealers";
	$dsn = "mysql:host=$servername;dbname=$dbname";

	// connect to database
	$username = "efftwelv_andrew";
	$password = "Andrew1000";

	try 
	{		
		$conn = mysqli_connect($servername,$username,$password,$dbname);
	}
	catch(PDOException $e)
	{
		echo "<script>alert('Connection failed: ')</script>";
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
		
		<div class="container">
		<h1>Your Matches</h1>
		<br>
			
			<!-- new matches -->
			<?php
				// TEMPORARY QUERY
				// MySQL database query
				$queryID = "SELECT *";
				$queryID .= "FROM vehicle ";
				$queryID .= "WHERE 1";
				// echo "<script>alert('$queryID')</script>";
				
				$result = mysqli_query($conn, $queryID);
				
				// Test query error
				if(!$result){
						die("Database query failed. ");
				}
				
				// get number of rows returned by query
				$row_cnt = $result->num_rows;

				//printf("Result set has %d rows.\n", $row_cnt);
				echo "<h2>Congratulations! You have ".$row_cnt. " new matches!</h2>";
	
				//incrementer for modal id
				$modelNum = 0;
						
				while($row = mysqli_fetch_assoc($result)){
					echo '<section class="row col-sm-12 carShortInfo" data-toggle="modal" data-target="#mod'.$modelNum.'">';
					//echo '<a class="carLink" href="carPage.php">';
					echo "<article class='col-sm-10'>";
					echo "<ul class='carInfoList'>";
					echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
					echo " {$row['car_model_id']}<h3></li>";
					echo "<li><h6>$ {$row['car_price']}<h6></li>";
					echo "<li>Dealership</li>";
					echo "<li>Suburb/Town, STATE</li>";
					// echo "<li>{$row['description']}</li>";
					echo "</a>";
					echo '<a class="carLink" href="carPage.php">';
					echo "</article>";
					echo "<aside class='col-sm-2'>";
					echo '<img height=150 width=200 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
					echo "</aside>";
					echo "</a>";
					echo "</section>";
					
					// modal
					// some of the following code was sourced from: https://www.w3schools.com/bootstrap/bootstrap_modal.asp
					echo '<div class="modal fade" id="mod'.$modelNum.'" role="dialog">';
					echo '<div class="modal-dialog modal-lg">';

					// modal content
					echo '<div class="modal-content">';
					echo '<div class="modal-header">';
					echo "<h4 class='modal-title'>{$row['car_make_id']} {$row['car_model_id']}</h4>";
					echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
					echo '</div>';
					echo '<div class="modal-body">';
					echo '<p>Im thinking this should contain extensive info on the vehicle / dealer. This may be unneccisary duplication, if so, I was thinking it would still be nice to offer the dealer options in a modal like this</p>';
					echo '<img height=500 width=765 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
					echo '</div>';
					echo '<div class="modal-footer">';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">Remove Vehicle</button>';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">View Vehicle</button>';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">Make an Offer</button>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
							
					$modelNum++;
				}

				// release returned data
				mysqli_free_result($result);						
			?>
			
			</div>
			<br>
			
			<!-- old matches -->
			<div class="container">
			<h2>Stored matches</h2>
			
			<!-- TEMPORARY QUERY -->
			<?php
						// MySQL database query
						$queryID = "SELECT *";
						$queryID .= "FROM vehicle ";
						$queryID .= "WHERE 1";
						// echo "<script>alert('$queryID')</script>";
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
						
						//incrementer for modal id
						$modelNum = 0;
						
						while($row = mysqli_fetch_assoc($result)){
							echo '<section class="row col-sm-12 carShortInfo" data-toggle="modal" data-target="#mod'.$modelNum.'">';
							//echo '<a class="carLink" href="carPage.php">';
							echo "<article class='col-sm-10'>";
							echo "<ul class='carInfoList'>";
							echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
							echo " {$row['car_model_id']}<h3></li>";
							echo "<li><h6>$ {$row['car_price']}<h6></li>";
							echo "<li>Dealership</li>";
							echo "<li>Suburb/Town, STATE</li>";
							// echo "<li>{$row['description']}</li>";
							echo "</a>";
							echo '<a class="carLink" href="carPage.php">';
							echo "</article>";
							echo "<aside class='col-sm-2'>";
							echo '<img height=150 width=200 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
							echo "</aside>";
							echo "</a>";
							echo "</section>";
							
							// modal
							// some of the following code was sourced from: https://www.w3schools.com/bootstrap/bootstrap_modal.asp
							echo '<div class="modal fade" id="mod'.$modelNum.'" role="dialog">';
							echo '<div class="modal-dialog modal-lg">';

							// modal content
							echo '<div class="modal-content">';
							echo '<div class="modal-header">';
							echo "<h4 class='modal-title'>{$row['car_make_id']} {$row['car_model_id']}</h4>";
							echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
							echo '</div>';
							echo '<div class="modal-body">';
							echo '<p>Im thinking this should contain extensive info on the vehicle / dealer. This may be unneccisary duplication, if so, I was thinking it would still be nice to offer the dealer options in a modal like this</p>';
							echo '<img height=500 width=765 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
							echo '</div>';
							echo '<div class="modal-footer">';
							echo '<button type="button" class="btn btn-default" data-dismiss="modal">Remove Vehicle</button>';
							echo '<button type="button" class="btn btn-default" data-dismiss="modal">View Vehicle</button>';
							echo '<button type="button" class="btn btn-default" data-dismiss="modal">Make an Offer</button>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							
							$modelNum++;
						}
					
						// release returned data
						mysqli_free_result($result);
							
						// close database connection
						mysqli_close($conn);
								
						
					?>
					</div>
		</div>
  
</div>
		<div>		
		<footer class="page-footer">
			<div class="footerTxt container-fluid text-left">
				<a class="footerTxt" href="#">Privacy Policy</a>
				<a class="footerTxt" href="#">Contact</a>
				<a class="footerTxt" href="#">Logout</a>
			</div>
		</footer>

	</body>
</html>
