<?php 
	session_start();
	
	$title = "Vehicle Match Info";
	require 'php/header.php';
	require 'conn.php';
?>


<!doctype html>
<html lang="en">
	
		
		<!-- the following css is just here temporarily -->
		<!-- the following code was sourced from: https://www.w3schools.com/howto/howto_css_modal_images.asp -->
		<style>
		
		#vehicleInfoTable {
			width:33%;
		}
		
		
		#myImg {
			padding: 10px;
			width: 100%;
		}
		
		body {font-family: Arial, Helvetica, sans-serif;}

		#myImg {
			border-radius: 5px;
			cursor: pointer;
			transition: 0.3s;
		}

		#myImg:hover {opacity: 0.7;}

		/* The Modal (background) */
		.modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			padding-top: 100px; /* Location of the box */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgb(0,0,0); /* Fallback color */
			background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
		}

		/* Modal Content (image) */
		.modal-content {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
		}

		/* Caption of Modal Image */
		#caption {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
			text-align: center;
			color: #ccc;
			padding: 10px 0;
			height: 150px;
		}

		/* Add Animation */
		.modal-content, #caption {    
			-webkit-animation-name: zoom;
			-webkit-animation-duration: 0.6s;
			animation-name: zoom;
			animation-duration: 0.6s;
		}

		@-webkit-keyframes zoom {
			from {-webkit-transform:scale(0)} 
			to {-webkit-transform:scale(1)}
		}

		@keyframes zoom {
			from {transform:scale(0)} 
			to {transform:scale(1)}
		}

		/* The Close Button */
		.close {
			position: absolute;
			top: 15px;
			right: 35px;
			color: #f1f1f1;
			font-size: 40px;
			font-weight: bold;
			transition: 0.3s;
		}

		.close:hover,
		.close:focus {
			color: #bbb;
			text-decoration: none;
			cursor: pointer;
		}

		/* 100% Image Width on Smaller Screens */
		@media only screen and (max-width: 700px){
			.modal-content {
				width: 100%;
			}
		}
		
		/* the following css is just here temporarily */
		/* the following code was sourced from: https://codepen.io/Bluetidepro/pen/GkpEa */
		.star-ratings-css {
			unicode-bidi: bidi-override;
			color: #c5c5c5;
			font-size: 25px;
			height: 25px;
			width: 100px;
			margin: 0 auto;
			position: absolute;
			top: 112px;
			/* padding: 10; */
			text-shadow: 0px 1px 0 #a2a2a2;
		}
		
		.star-ratings-css-top {
			color: #e7711b;
			/* padding: 10; */
			position: absolute;
			z-index: 1;
			display: block;
			top: 0;
			left: 0;
			overflow: hidden;
		}
		.star-ratings-css-bottom {
			/* padding: 10; */
			display: block;
			z-index: 0;
		}

		
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}
		
		</style>
		
		
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php require 'php/navAccess.php' ?>

		
		<div class="container">
		<h1>Vehicle Information</h1>
		<hr>
			
		<div class="container">
			
		<!-- TEMPORARY QUERY -->
		<?php

					// get the car_vin sent from the match page
					$car_vin=$_GET['car_vin'];
					$match_req_id=$_GET['match_request_id'];
					
					// MySQL database query
					$queryID = "SELECT *";
					$queryID .= "FROM vehicle ";
					$queryID .= "INNER JOIN users ";
					$queryID .= "ON vehicle.user_id=users.id ";
					$queryID .= "WHERE `car_vin`='{$car_vin}'";

					
					$result = mysqli_query($conn, $queryID);
					
					// Test query error
					if(!$result){
							die("Database query failed. ");
					}
					
					
					
					while($row = mysqli_fetch_assoc($result)){
						
						// query for match info
						$innerMatchQuery = "SELECT *";
						$innerMatchQuery .= "FROM match_request ";
						$innerMatchQuery .= "WHERE id=$match_req_id";					
						
						$innerMatchList = mysqli_query($conn, $innerMatchQuery);

						while($matchRow = mysqli_fetch_assoc($innerMatchList)){
						
						echo "<div class='row'>";						
						echo "<article class='col-sm-7'>";
						echo "<ul class='carInfoList'>";
						echo "<li><h2 class='carTitle'>{$row['car_make_id']}";
						echo " {$row['car_model_id']}<h2></li>";
						echo "<br>";						
						echo "<li><h6>$ {$row['car_price']}<h6></li>";
						echo "<li>{$row['dealer_name']}";
						
						// star rating of the dealership
						// the following code was sourced from: https://codepen.io/Bluetidepro/pen/GkpEa
						// adjusting 'star-ratings-css-top width' will change the number of colored stars
						echo '<div class="star-ratings-css">';
						echo '<div class="star-ratings-css-top" style="width: 54%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>';
						echo '<div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>';
						echo '</div>';
						echo "</li>";
						echo "<br>";
						
						echo "<li>{$row['dealer_location']}</li>";
						echo "<br>";
						
						
						// button to send a message to the seller
						echo "<form action='reply.php' method='post' >";
						echo "<input type='hidden' name='carVin' value='{$row['car_vin']}'>";
						echo "<p>Interested? Send the dealer a message:</p>";
						echo "<button type='submit' name='submit' value='submit' class='btn btn-sm btn-outline-secondary'>Message Dealer</button>";
						echo "</form></article>";
						
						
						echo "<aside class='col-sm-5' id='imgCont'>";
						echo '<img id="myImg" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
						echo "</aside>";
						
						echo "</div>";
						
						echo "<table>";
						echo "<tr><td id='vehicleInfoTable'><b>Field</b></td><td id='vehicleInfoTable'><b>Vehicle Details</b></td><td id='vehicleInfoTable'><b>Your Match Request</b></td></tr>";
						echo "</table>";
						
						echo "<table>";
						echo "<tr><td id='vehicleInfoTable'><b>Vehicle</b></td><td id='vehicleInfoTable'>{$row['car_make_id']} {$row['car_model_id']}</td><td id='vehicleInfoTable'>{$matchRow['make_request']} {$matchRow['model_request']}</td></tr>";						
						echo "<tr><td id='vehicleInfoTable'><b>Year</b></td><td id='vehicleInfoTable'>{$row['car_year']}</td><td id='vehicleInfoTable'>{$matchRow['year_min_request']} - {$matchRow['year_max_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Condition</b></td><td id='vehicleInfoTable'>{$row['car_new_used_condition']}</td><td id='vehicleInfoTable'>{$matchRow['condition_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Kilometers</b></td><td id='vehicleInfoTable'>{$row['car_kilometers']}</td><td id='vehicleInfoTable'>Under {$matchRow['max_kilometers_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Exterior Color</b></td><td id='vehicleInfoTable'>{$row['car_exterior_color']}</td><td id='vehicleInfoTable'>{$matchRow['exterior_color_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Interior Color</b></td><td id='vehicleInfoTable'>{$row['car_interior_color']}</td><td id='vehicleInfoTable'>{$matchRow['interior_color_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Body Type</b></td><td id='vehicleInfoTable'>{$row['car_body_type_id']}</td><td id='vehicleInfoTable'>{$matchRow['body_type_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Transmission</b></td><td id='vehicleInfoTable'>{$row['car_transmission_type_id']}</td><td id='vehicleInfoTable'>{$matchRow['transmission_type_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Drive Type</b></td><td id='vehicleInfoTable'>{$row['car_drive_type']}</td><td id='vehicleInfoTable'>{$matchRow['drive_type_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Engine Size</b></td><td id='vehicleInfoTable'>{$row['car_engine_size']}</td><td id='vehicleInfoTable'>{$matchRow['engine_size_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Fuel Type</b></td><td id='vehicleInfoTable'>{$row['car_fuel_type']}</td><td id='vehicleInfoTable'>{$matchRow['fuel_type_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Capacity</b></td><td id='vehicleInfoTable'>{$row['car_capacity']}</td><td id='vehicleInfoTable'>Atleast {$matchRow['min_capacity_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Number of Doors</b></td><td id='vehicleInfoTable'>{$row['car_num_doors']}</td><td id='vehicleInfoTable'>Atleast {$matchRow['min_num_doors_request']}</td></tr>";
						echo "<tr><td id='vehicleInfoTable'><b>Description</b></td><td id='vehicleInfoTable'>{$row['description']}</td><td></td></tr>";
						echo "</table>";
						echo "<br>";
					}
					}
				
					// release returned data
					mysqli_free_result($result);
						
					// close database connection
					mysqli_close($conn);
							
				?>
						
				<!-- the following code was sourced from: https://www.w3schools.com/howto/howto_css_modal_images.asp -->
				<!-- The Modal -->
				<div id="myModal" class="modal">
				<span class="close">&times;</span>
				<img class="modal-content" id="img01">
				<div id="caption"></div>
				</div>
				
				<!-- email dealer box 
				Interested? Send the dealer an e-mail:
				<br>
				<form action="mailto:someone@example.com" method="post" enctype="text/plain">
					<input type="text" name="comment" style="width:1078px;height:200px;">
					<input type="submit" value="Send">
					<input type="reset" value="Reset">
				</form>
				<br>
				-->
				</div>
		</div>

		<?php 
			require 'php/logRegmodals.php';
		?>
		
	
	<?php 
		require 'php/footer.php';
	?>

	</body>
</html>

<!-- code for the enlarge image modal -->
<!-- the following code was sourced from: https://www.w3schools.com/howto/howto_css_modal_images.asp -->
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}

modal.addEventListener('click',function(){
this.style.display="none";
})
</script>