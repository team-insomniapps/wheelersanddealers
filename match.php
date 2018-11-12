<?php 
	session_start();
	
	$title = "Match";
	require 'php/header.php';
	require 'conn.php';
	
?>

<?php
	
	$userID = $_SESSION['loginID'];
	
	if(isset($_POST['remove_vehicle'])){
		
		// variables to hold post information by form
		// TEMPORARY - NEED TO DYNAMICALLY GET USER ID
		$vehicleVin = $_POST['value'];
		$matchRequestID = $_POST['matchRequestID'];
		
		try
		{
			// add a vehicle to the match_removed_vehicles table
			$query_add_vehicle = "INSERT INTO `match_removed_vehicles` (`user_id`, `removed_vehicle`, `match_id`)
								  VALUES ('{$userID}','{$vehicleVin}', '{$matchRequestID}')";
			mysqli_query($conn, $query_add_vehicle);
			
			// echo "Connected successfully"; 
			echo "<script>alert('Vehicle successfully removed from match list')</script>";
		}
		catch(PDOException $e)
		{
			echo "<script>alert('Connection failed')</script>";
		}
	}
?>

<!doctype html>
<html lang="en">
	<head>
		
		<!-- this is temporary and will eventualy be moved to the css folder -->
		<style>
		#requestInfoTable {
			list-style: none;
		}
		
		#newMatches {
			background-color: lightblue;
		}
		
		<!-- tab code was sourced from: https://www.w3schools.com/howto/howto_js_tabs.asp -->
		/* Style the tab */
		.tab {
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
		}

		/* Style the buttons that are used to open the tab content */
		.tab button {
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 16px;
			transition: 0.3s;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
			background-color: #ddd;
		}

		/* Create an active/current tablink class */
		.tab button.active {
			background-color: #ccc;
		}

		/* Style the tab content */
		.tabcontent {
			display: none;
			padding: 6px 12px;
			border: 1px solid #ccc;
			border-top: none;
		}
		
		.tabcontent {
			animation: fadeEffect 1s; /* Fading effect takes 1 second */
		}

		/* Go from zero to full opacity */
			@keyframes fadeEffect {
			from {opacity: 0;}
			to {opacity: 1;}
		}
		</style>
		
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php require 'php/navAccess.php' ?>
    	
		<div class="container">

			<h1>Your Matches</h1>
			<br>
		
			<!-- tab code was sourced from: https://www.w3schools.com/howto/howto_js_tabs.asp -->
			<!-- Tab links -->
			<div class="tab">
				<button class="tablinks" onclick="openTab(event, 'New')" id="defaultOpen">New Matches</button>
				<button class="tablinks" onclick="openTab(event, 'Saved')">Stored Matches</button>
			</div>

			<!-- im sure theres a better way of seperating things rather than using multiple <br> tags -->
			<br>
			<br>
			<br>
			<div class="row">
				<section class="col-sm-12">
					<div id="New" class="tabcontent">
						<article class="row carShortArticle">
						
						<!-- new matches -->
						<?php
						// get users match requests from match_request table
						// TEMPORARY QUERY, THE USER ID WILL HAVE TO BE SET TO MATCH CURRENT USERS ID
						$matchRequestsID = "SELECT *";
						$matchRequestsID .= "FROM match_request ";
						$matchRequestsID .= "WHERE `user_id`='".$userID."'";
						$matchRequests = mysqli_query($conn, $matchRequestsID);
				
						// Test query error
						if(!$matchRequests){
								die("Database query failed.");
						}
						
						echo "";
						
						//incrementer for modal id
						$modelNum = 0;
						
						// different heading displayed depending on wether or not user has new matches
						echo "<h2 class='newMatchesHeading'>Congratulations! You have new matches!</h2>";
						echo "<h2 class='noNewMatchesHeading'>You have no new matches</h2>";
						
						echo '<div class="col-sm-12" id="newMatches">';
						
						
		
						
						while($requestRow = mysqli_fetch_assoc($matchRequests)){
							// put match request result into variables
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
							$matchRequestID = $requestRow['id'];
							
							// find vehicles which match the request and are not in the users match_removed_vehicles list
							$matchqueryID = "SELECT * ";
							$matchqueryID .= "FROM vehicle ";
							$matchqueryID .= "JOIN users ";
							$matchqueryID .= "ON vehicle.user_id=users.id ";
							// dont include vehicles which the user has blacklisted
							$matchqueryID .= "AND vehicle.car_vin NOT IN (SELECT removed_vehicle FROM match_removed_vehicles WHERE '$userID'=match_removed_vehicles.user_id) ";
							// dont include vehicles which the user has already viewed
							$matchqueryID .= "AND vehicle.car_vin NOT IN (SELECT removed_vehicle FROM match_stored_vehicles WHERE '$userID'=match_stored_vehicles.user_id) ";
							
							if($make != NULL) {
								$matchqueryID .= "WHERE `car_make_id`='3' ";
							}
							else {
								$matchqueryID .= "WHERE `car_make_id`!='NULL' ";
							}
							if($model != NULL) {
								$matchqueryID .= " && `car_model_id`='$model' ";
							}
							if($body_style != NULL) {
								$matchqueryID .= " && `car_body_type_id`='$body_style' ";
							}
							if($door != NULL && $door != 0) {
								$matchqueryID .= " && `car_num_doors`>='$door' ";
							}
							if($yearmin != NULL && $yearmin != 0) {
								$matchqueryID .= " && `car_year`>='$yearmin' ";
							}
							if($yearmax != NULL && $yearmax != 0) {
								$matchqueryID .= " && `car_year`<='$yearmax' ";
							}
							if($trans != NULL) {
								$matchqueryID .= " && `car_transmission_type_id`='$trans' ";
							}
							if($ex_Color != NULL) {
								$matchqueryID .= " && `car_exterior_color`='$ex_Color' ";
							}
							if($fuel != NULL) {
								$matchqueryID .= " && `car_fuel_type`='$fuel' ";
							}
							if($drive != NULL) {
								$matchqueryID .= " && `car_drive_type`='$drive' ";
							}
							if($mile_max != NULL && $mile_max != 0) {
								$matchqueryID .= " && `car_kilometers`<='$mile_max' ";
							}
							if($cond != NULL) {
								$matchqueryID .= " && `car_new_used_condition`='$cond' ";
							}
							if($pricemin != NULL && $pricemin != 0) {
								$matchqueryID .= " && `car_price`>='$pricemin' ";
							}
							if($pricemax != NULL && $pricemax != 0) {
								$matchqueryID .= " && `car_price`<='$pricemax' ";
							}
														
							$matchList = mysqli_query($conn, $matchqueryID);
							
							
							
							if(!$matchList){
								die("Database query failed. here");
							}
						
							
							while($row = mysqli_fetch_assoc($matchList)){
								
								// variable for adding vehicle to match_stored_vehicles table
								$vehicleVin = $row['car_vin'];
								// add vehicle to match_stored_vehicles so it will appear in 'stored' tab next time rather than 'new matches'
								// userID currently hard coded to 2
								$query_vehicle_to_stored = "INSERT INTO `match_stored_vehicles` (`user_id`, `removed_vehicle`, `match_id`)
															VALUES ('{$userID}','{$vehicleVin}', '{$matchRequestID}')";
								mysqli_query($conn, $query_vehicle_to_stored);
							
								// display breif information about each vehicle
								echo '<section class="row col-sm-12 carShortInfo" data-toggle="modal" data-target="#mod'.$modelNum.'">';
									echo "<article class='col-sm-6'>";
										echo "<ul class='carInfoList'>";
											echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
											echo " {$row['car_model_id']}<h3></li>";
											echo "<li><h6>$ {$row['car_price']}<h6></li>";
											echo "<li>{$row['dealer_name']}</li>";
											echo "<li>{$row['dealer_location']}</li>";
										echo "</ul>";
									echo "</article>";
									echo '<aside class="col-sm-6" data-toggle="modal" data-target="#mod'.$modelNum.'">';
										echo '<img class="carPhoto" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'" data-toggle="modal" data-target="#mod'.$modelNum.'">';
									echo "</aside>";
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
														if($make != NULL && $model != NULL) {
															echo "<li><b>Vehicle: </b>$make $model</li>";
														}
														else if($make != NULL){
															echo "<li><b>Vehicle: </b>$make</li>";
														}
														else if($model != NULL){
															echo "<li><b>Vehicle: </b>$model</li>";
														}
														if($yearmin != NULL) {
															echo "<li><b>Minimum Year: </b>$yearmin</li>";
														}
														if($yearmax != NULL) {
															echo "<li><b>Maximum Year: </b>$yearmax</li>";
														}
														if($cond != NULL) {
															echo "<li><b>Condition: </b>$cond</li>";
														}
														if($mile_max != NULL) {
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
														if($door != NULL) {
															echo "<li><b>Minimum Number of Doors: </b>$door</li>";
														}
														echo '</ul>';
														echo '<img height=500 width=765 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
													echo '</div>';
													echo '<div class="modal-footer">';
														echo "<button type='button' class='btn btn-default' onclick= location.href='vehicle_match_info.php?car_vin={$row['car_vin']}&match_request_id={$requestRow['id']}' id=".htmlspecialchars($row['car_vin']).">View Vehicle</a>";
														// button for adding vehicle to match_removed_vehicles table
														echo '<form method="post" enctype="multipart/form-data" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>';
															echo "<input type='hidden' name='value' placeholder='Mandatory' value='{$row['car_vin']}'>";
															echo "<input type='hidden' name='matchRequestID' placeholder='Mandatory' value='{$requestRow['id']}'>";
															echo '<button type="submit" name="remove_vehicle" class="form-control btn btn-primary">Remove Vehicle</button>';
														echo '</form>';
													
													echo '</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
								
									$modelNum++;
							}
							
							// release returned data
							mysqli_free_result($matchList);			
						}
						
						// conditional for heading above list of matches
						// different heading will be displayed if there are no new matches
						if($modelNum == 0)
						{
							echo '<style type="text/css">h2.newMatchesHeading { display: none;}</style>';
						}
						else
						{
							echo '<style type="text/css">h2.noNewMatchesHeading { display: none;}</style>';
						}
						echo '</div>';
										
							?>
						</article>
					</div>
					<div id="Saved" class="tabcontent">
					
						<!-- stored matches -->	
						<?php
						// first get users match requests from match_request table
						// TEMPORARY QUERY, THE USER ID WILL HAVE TO BE SET TO MATCH CURRENT USERS ID
						$storedMatchRequestsID = "SELECT *";
						$storedMatchRequestsID .= "FROM match_request ";
						$storedMatchRequestsID .= "WHERE `user_id`='$userID'";
						$storedMatchRequests = mysqli_query($conn, $storedMatchRequestsID);
				
		
							
						// Test query error
						if(!$storedMatchRequests){
								die("Database query failed. ");
						}
							
							echo'<h2>Stored matches</h2>';
						
						while($storedRequestRow = mysqli_fetch_assoc($storedMatchRequests)){
							// put match request result into variables
							$make = $storedRequestRow['make_request'];
							$model = $storedRequestRow['model_request'];
							$body_style = $storedRequestRow['body_type_request'];
							$door = $storedRequestRow['min_num_doors_request'];
							$yearmin = $storedRequestRow['year_min_request'];
							$yearmax = $storedRequestRow['year_max_request'];
							$trans = $storedRequestRow['transmission_type_request'];
							$ex_Color = $storedRequestRow['exterior_color_request'];
							$fuel = $storedRequestRow['fuel_type_request'];
							$drive = $storedRequestRow['drive_type_request'];
							$mile_max = $storedRequestRow['max_kilometers_request'];
							$cond = $storedRequestRow['condition_request'];
							$pricemin = $storedRequestRow['min_price_request'];
							$pricemax = $storedRequestRow['max_price_request'];
							// find vehicles which match the request and are not in the users match_removed_vehicles list
							$storedMatchqueryID = "SELECT *";
							$storedMatchqueryID .= "FROM vehicle ";
							$storedMatchqueryID .= "JOIN users ";
							$storedMatchqueryID .= "ON vehicle.user_id=users.id ";
							$storedMatchqueryID .= "AND vehicle.car_vin NOT IN (SELECT removed_vehicle FROM match_removed_vehicles WHERE '$userID'=match_removed_vehicles.user_id)";
							
							
							
							if($make != NULL) {
								$storedMatchqueryID .= "WHERE `car_make_id`='$make'";
							}
							else {
								$storedMatchqueryID .= "WHERE `car_make_id`!='NULL'";
							}
							if($model != NULL) {
								$storedMatchqueryID .= " && `car_model_id`='$model'";
							}
							if($body_style != NULL) {
								$storedMatchqueryID .= " && `car_body_type_id`='$body_style'";
							}
							if($door != NULL && $door != 0) {
								$storedMatchqueryID .= " && `car_num_doors`>='$door'";
							}
							if($yearmin != NULL && $yearmin != 0) {
								$storedMatchqueryID .= " && `car_year`>='$yearmin'";
							}
							if($yearmax != NULL && $yearmax != 0) {
								$storedMatchqueryID .= " && `car_year`<='$yearmax'";
							}
							if($trans != NULL) {
								$storedMatchqueryID .= " && `car_transmission_type_id`='$trans'";
							}
							if($ex_Color != NULL) {
								$storedMatchqueryID .= " && `car_exterior_color`='$ex_Color'";
							}
							if($fuel != NULL) {
								$storedMatchqueryID .= " && `car_fuel_type`='$fuel'";
							}
							if($drive != NULL) {
								$storedMatchqueryID .= " && `car_drive_type`='$drive'";
							}
							if($mile_max != NULL && $mile_max != 0) {
								$storedMatchqueryID .= " && `car_kilometers`<='$mile_max'";
							}
							if($cond != NULL) {
								$storedMatchqueryID .= " && `car_new_used_condition`='$cond'";
							}
							if($pricemin != NULL && $pricemin != 0) {
								$storedMatchqueryID .= " && `car_price`>='$pricemin'";
							}
							if($pricemax != NULL && $pricemax != 0) {
								$storedMatchqueryID .= " && `car_price`<='$pricemax'";
							}
							
							$storedMatchList = mysqli_query($conn, $storedMatchqueryID);
							
							if(!$storedMatchList){
								die("Database query failed. ");
							}
							
							while($storedRow = mysqli_fetch_assoc($storedMatchList)){
								echo '<section class="row col-sm-12 carShortInfo" data-toggle="modal" data-target="#mod'.$modelNum.'">';
									echo "<article class='col-sm-6'>";
										echo "<ul class='carInfoList'>";
											echo "<li><h4 class='carTitle'>{$storedRow['car_make_id']}";
											echo " {$storedRow['car_model_id']}<h3></li>";
											echo "<li><h6>$ {$storedRow['car_price']}<h6></li>";
											echo "<li>{$storedRow['dealer_name']}</li>";
											echo "<li>{$storedRow['dealer_location']}</li>";
										echo "</ul>";
									echo "</article>";
									echo '<aside class="col-sm-6" data-toggle="modal" data-target="#mod'.$modelNum.'">';
										echo '<img class="carPhoto" src="data:image/jpeg;base64,'.base64_encode( $storedRow['photo'] ).'" data-toggle="modal" data-target="#mod'.$modelNum.'">';
									echo "</aside>";
								echo "</section>";
						
								// modal
								// some of the following code was sourced from: https://www.w3schools.com/bootstrap/bootstrap_modal.asp
									echo '<div class="modal fade" id="mod'.$modelNum.'" role="dialog">';
										echo '<div class="modal-dialog modal-lg">';
											// modal content
											echo '<div class="modal-content">';
												echo '<div class="modal-header">';
													echo "<h4 class='modal-title'>{$storedRow['car_make_id']} {$storedRow['car_model_id']}</h4>";
														echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
													echo '</div>';
													echo '<div class="modal-body">';
														echo '<h5>This vehicle matches your request for:</h5>';
														echo '<ul id="requestInfoTable">';
														if($make != NULL && $model != NULL) {
															echo "<li><b>Vehicle: </b>$make $model</li>";
														}
														if($yearmin != NULL) {
															echo "<li><b>Minimum Year: </b>$yearmin</li>";
														}
														if($yearmax != NULL) {
															echo "<li><b>Maximum Year: </b>$yearmax</li>";
														}
														if($cond != NULL) {
															echo "<li><b>Condition: </b>$cond</li>";
														}
														if($mile_max != NULL) {
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
														if($door != NULL) {
															echo "<li><b>Minimum Number of Doors: </b>$door</li>";
														}
														echo '</ul>';
														echo '<img height=500 width=765 img src="data:image/jpeg;base64,'.base64_encode( $storedRow['photo'] ).'"/>';
													echo '</div>';
													echo '<div class="modal-footer">';
														echo "<button type='button' class='btn btn-default' onclick= location.href='vehicle_match_info.php?car_vin={$storedRow['car_vin']}&match_request_id={$storedRequestRow['id']}' id=".htmlspecialchars($storedRow['car_vin']).">View Vehicle</a>";
														// button for adding vehicle to match_removed_vehicles table
														echo '<form method="post" enctype="multipart/form-data" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>';
															echo "<input type='hidden' name='value' placeholder='Mandatory' value='{$storedRow['car_vin']}'>";
															echo "<input type='hidden' name='matchRequestID' placeholder='Mandatory' value='{$storedRequestRow['id']}'>";
															echo '<button type="submit" name="remove_vehicle" class="form-control btn btn-primary">Remove Vehicle</button>';
														echo '</form>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
								
									$modelNum++;
							}
							
							// release returned data
							mysqli_free_result($storedMatchList);			
							
						}
					
								echo '</div>';
										
						// close db connection
						mysqli_close($conn);					
						?>
						</div>
						<!-- </article> -->
				</section>
			</div>
		</div>
			
		<!-- seperates the fields holding information on the match request the user made into two columns -->
		<script>
			$(document).ready(function() {
			$("ul#requestInfoTable").css("column-count",2);
			});
			
		<!-- set new matches tab to open by defalt when page loads -->
		document.getElementById("defaultOpen").click();
			
		<!-- tab code was sourced from: https://www.w3schools.com/howto/howto_js_tabs.asp -->
		function openTab(evt, tabName) {
		// Declare all variables
		var i, tabcontent, tablinks;
		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		// Get all elements with class="tablinks" and remove the class "active"
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		// Show the current tab, and add an "active" class to the button that opened the tab
		document.getElementById(tabName).style.display = "block";
		evt.currentTarget.className += " active";
		}		
		</script>
  
		<?php 
			//require 'php/logRegmodals.php';
			require 'php/footer.php';
		?>

	</body>
</html>