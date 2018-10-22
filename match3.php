<?php
session_start();
?>
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
		
		<!-- this is temporary and will eventualy be moved to the css folder -->
		<style>
		#requestInfoTable {
			list-style: none;
		}
		
		#newMatches {
			background-color: lightblue;
		}
		</style>
		
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<nav class="navbar navbar-expand-lg">
			<!-- branding logo image -->
			<a class="navbar-brand" href="http://www.wheelersanddealers.efftwelve.com/index_log.php">
				<img src="images/logo_uncoloured.svg" class="navLogo">
			</a>
			<!-- collapse navigation to hamburger on small/mobile screens -->
			<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			
			<!-- navigation bar -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
				<ul class="navbar-nav mr-auto mx-auto">
					<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="inventory.php">Inventory <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="#">Messages</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Account & Settings</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Help</a></li>
				</ul>
					
					
				</ul>
				<!-- login/logout button -->
				<div>
					<a class="logBtn btn btn-sm btn-outline-secondary"  href="index.php">Logout</a>
				</div>
			</div>
		</nav>
			
			<div class="main">

		<h1>Your Matches</h1>
		<br>
		<div class="row">
			<section class="col-sm-12">
					<article class="row carShortArticle">
					
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
				
				echo '<div class="col-sm-12" id="newMatches">';
				
				while($row = mysqli_fetch_assoc($result)){
					echo '<section class="row col-sm-12 carShortInfo" data-toggle="modal" data-target="#mod'.$modelNum.'">';
					//echo '<a class="carLink" href="carPage.php">';
					echo "<article class='col-sm-6'>";
					echo "<ul class='carInfoList'>";
					echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
					echo " {$row['car_model_id']}<h3></li>";
					echo "<li><h6>$ {$row['car_price']}<h6></li>";
					echo "<li>Dealership</li>";
					echo "<li>Suburb/Town, STATE</li>";
					// echo "<li>{$row['description']}</li>";
					echo "</a>";
					//echo '<a class="carLink" href="carPage.php">';
					echo "</article>";
					echo '<aside class="col-sm-6" data-toggle="modal" data-target="#mod'.$modelNum.'">';
					echo '<img class="carPhoto" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'" data-toggle="modal" data-target="#mod'.$modelNum.'">';
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
					echo '<h5>This vehicle matches your request for:</h5>';
					echo '<ul id="requestInfoTable">';
						echo "<li><b>Vehicle: </b>{$row['car_make_id']} {$row['car_model_id']}</li>";
						echo "<li><b>Year: </b>{$row['car_year']}</li>";
						echo "<li><b>Condition: </b>{$row['car_new_used_condition']}</li>";
						echo "<li><b>Kilometers: </b>{$row['car_kilometers']}</li>";
						echo "<li><b>Exterior Color: </b>{$row['car_exterior_color']}</li>";
						echo "<li><b>Interior Color: </b>{$row['car_interior_color']}</li>";
						echo "<li><b>Body Type: </b>{$row['car_body_type_id']}</li>";
						echo "<li><b>Transmission: </b>{$row['car_transmission_type_id']}</li>";
						echo "<li><b>Drive Type: </b>{$row['car_drive_type']}</li>";
						echo "<li><b>Engine Size: </b>{$row['car_engine_size']}</li>";
						echo "<li><b>Fuel Type: </b>{$row['car_fuel_type']}</li>";
						echo "<li><b>Capacity: </b>{$row['car_capacity']}</li>";
						echo "<li><b>Number of Doors: </b>{$row['car_num_doors']}</li>";
					echo '</ul>';
					echo '<img height=500 width=765 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
					echo '</div>';
					echo '<div class="modal-footer">';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">Remove Vehicle</button>';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">View Vehicle</button>';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">Make an Offer</button>';
					//<button onclick="location.href='http://www.example.com'" type="button">www.example.com</button>
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
							
					$modelNum++;
				}
				
				echo '</div>';

				// release returned data
				mysqli_free_result($result);						
			?>
			
			<br><a href='vehicle_info.php?RoomID=<?php echo $row['RoomID']; ?>' id=".htmlspecialchars($row['RoomID']).">Reserve</a>
			<br>	
			
			<!-- old matches -->
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
					echo "<article class='col-sm-6'>";
					echo "<ul class='carInfoList'>";
					echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
					echo " {$row['car_model_id']}<h3></li>";
					echo "<li><h6>$ {$row['car_price']}<h6></li>";
					echo "<li>Dealership</li>";
					echo "<li>Suburb/Town, STATE</li>";
					// echo "<li>{$row['description']}</li>";
					echo "</a>";
					//echo '<a class="carLink" href="carPage.php">';
					echo "</article>";
					echo '<aside class="col-sm-6" data-toggle="modal" data-target="#mod'.$modelNum.'">';
					echo '<img class="carPhoto" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'" data-toggle="modal" data-target="#mod'.$modelNum.'">';
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
					echo '<h5>This vehicle matches your request for:</h5>';
					echo '<ul id="requestInfoTable">';
						echo "<li><b>Vehicle: </b>{$row['car_make_id']} {$row['car_model_id']}</li>";
						echo "<li><b>Year: </b>{$row['car_year']}</li>";
						echo "<li><b>Condition: </b>{$row['car_new_used_condition']}</li>";
						echo "<li><b>Kilometers: </b>{$row['car_kilometers']}</li>";
						echo "<li><b>Exterior Color: </b>{$row['car_exterior_color']}</li>";
						echo "<li><b>Interior Color: </b>{$row['car_interior_color']}</li>";
						echo "<li><b>Body Type: </b>{$row['car_body_type_id']}</li>";
						echo "<li><b>Transmission: </b>{$row['car_transmission_type_id']}</li>";
						echo "<li><b>Drive Type: </b>{$row['car_drive_type']}</li>";
						echo "<li><b>Engine Size: </b>{$row['car_engine_size']}</li>";
						echo "<li><b>Fuel Type: </b>{$row['car_fuel_type']}</li>";
						echo "<li><b>Capacity: </b>{$row['car_capacity']}</li>";
						echo "<li><b>Number of Doors: </b>{$row['car_num_doors']}</li>";
					echo '</ul>';
					echo '<img height=500 width=765 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
					echo '</div>';
					echo '<div class="modal-footer">';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">Remove Vehicle</button>';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">View Vehicle</button>';
					echo '<button type="button" class="btn btn-default" data-dismiss="modal">Make an Offer</button>';
					//<button onclick="location.href='http://www.example.com'" type="button">www.example.com</button>
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
					</article>
					</section>
					</div>
		</div>
  </div>
		<!-- seperates the fields holding information on the match request the user made into two columns -->
		<script>
			$(document).ready(function() {
			$("ul#requestInfoTable").css("column-count",2);
			});	
		</script>
  
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