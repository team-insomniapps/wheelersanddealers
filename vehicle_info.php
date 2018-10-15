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
		
		<!-- the following css is just here temporarily -->
		<!-- the following code was sourced from: https://www.w3schools.com/howto/howto_css_modal_images.asp -->
		<style>
		
		#myImg {
			position: relative;
			bottom: 218px;
			left: 650px;
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
			padding: 10;
			text-shadow: 0px 1px 0 #a2a2a2;
		}
		
		.star-ratings-css-top {
			color: #e7711b;
			padding: 10;
			position: absolute;
			z-index: 1;
			display: block;
			top: 0;
			left: 0;
			overflow: hidden;
		}
		.star-ratings-css-bottom {
			padding: 10;
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
					<li class="nav-item active"><a class="nav-link" href="index_log.php">Home</a></li>
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
		
		<div class="container">
		<h1>Vehicle Information</h1>
		<br>
			
		<div class="container">
			
		<!-- TEMPORARY QUERY -->
		<?php
					// MySQL database query
					$queryID = "SELECT *";
					$queryID .= "FROM vehicle ";
					$queryID .= "WHERE id=1";
					
					$result = mysqli_query($conn, $queryID);
					
					// Test query error
					if(!$result){
							die("Database query failed. ");
					}
					
					while($row = mysqli_fetch_assoc($result)){
						echo "<article class='col-sm-10'>";
						echo "<ul class='carInfoList'>";
						echo "<li><h2 class='carTitle'>{$row['car_make_id']}";
						echo " {$row['car_model_id']}<h2></li>";
						echo "<br>";						
						echo "<li><h6>$ {$row['car_price']}<h6></li>";
						echo "<li>Dealership";
						
						// star rating of the dealership
						// the following code was sourced from: https://codepen.io/Bluetidepro/pen/GkpEa
						// adjusting 'star-ratings-css-top width' will change the number of colored stars
						echo '<div class="star-ratings-css">';
						echo '<div class="star-ratings-css-top" style="width: 54%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>';
						echo '<div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>';
						echo '</div>';
						echo "</li>";
						echo "<br>";
						
						echo "<li>Suburb/Town, STATE</li>";
						echo "<br>";
						echo '<button type="button" class="btn btn-default" data-dismiss="modal">Make an Offer</button>';
						echo "</a>";
						echo "<aside class='col-sm-2' id='imgCont'>";
						echo '<img id="myImg" height=280 width=400 img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
						echo "</aside>";
						
						echo "</article>";
						
						echo "<h3>Details</h3>";
						echo "<table>";
						echo "<tr><td>Vehicle</td><td>{$row['car_make_id']} {$row['car_model_id']}</td></tr>";
						echo "<tr><td>Year</td><td>{$row['car_year']}</td></tr>";
						echo "<tr><td>Condition</td><td>{$row['car_new_used_condition']}</td></tr>";
						echo "<tr><td>Kilometers</td><td>{$row['car_kilometers']}</td></tr>";
						echo "<tr><td>Exterior Color</td><td>{$row['car_exterior_color']}</td></tr>";
						echo "<tr><td>Interior Color</td><td>{$row['car_interior_color']}</td></tr>";
						echo "<tr><td>Body Type</td><td>{$row['car_body_type_id']}</td></tr>";
						echo "<tr><td>Transmission</td><td>{$row['car_transmission_type_id']}</td></tr>";
						echo "<tr><td>Drive Type</td><td>{$row['car_drive_type']}</td></tr>";
						echo "<tr><td>Engine Size</td><td>{$row['car_engine_size']}</td></tr>";
						echo "<tr><td>Fuel Type</td><td>{$row['car_fuel_type']}</td></tr>";
						echo "<tr><td>Capacity</td><td>{$row['car_capacity']}</td></tr>";
						echo "<tr><td>Number of Doors</td><td>{$row['car_num_doors']}</td></tr>";
						echo "<tr><td>Description</td><td>{$row['description']}</td></tr>";
						echo "</table>";
						echo "<br>";
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
				
				<!-- email dealer box -->
				Interested? Send the dealer an e-mail:
				<br>
				<form action="mailto:someone@example.com" method="post" enctype="text/plain">
					<input type="text" name="comment" style="width:1078px;height:200px;">
					<input type="submit" value="Send">
					<input type="reset" value="Reset">
				</form>
				<br>
				
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