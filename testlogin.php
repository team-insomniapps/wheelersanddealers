
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/wheelers.css">
		
		<!-- link Jquery, Bootstrap -->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<title>Wheelers & Deelers - Login</title>
		
		<script>
			<!-- Generating year ranges -->
			var yearRangeStr; 
			var year = 2018;
			while (year > 1919){
				yearRangeStr += '<option value="' + year + '">';
				year -= 1;
			}
		</script>	
		<script>	
			<!-- generic loading -->
			function loadArray(array){
				var arrString = "";
				for (var i=0; i < array.length; i++){
					arrString += '<option value="' + array[i] + '">';
				}
				return arrString;
			}
		</script>
	</head>
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<nav class="navbar navbar-expand-lg">
			<!-- branding logo image -->
			<a class="navbar-brand" href="http://www.wheelersanddealers.efftwelve.com/index_log.php">
				<img src="images/logo_red.svg" class="navLogo">
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
					<li class="nav-item"><a class="nav-link" href="about.php">Help</a></li>
				</ul>

				</ul>
				<!-- login/logout button -->
				<div>
					
					<!-- <a class="logBtn btn btn-sm btn-outline-secondary"  href="index.php">Login</a>
					-->
					<button type="button" class="logBtn btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#myModal">Login</button>
					
					<button type="button" class="logBtn btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#myModal2">Register</button>
				
				</div>
				
				<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
					  <div class="modal-dialog">

						  <!-- Modal content-->
					  <div class="modal-content">
						<div class="modal-header">
							<img src="images/logo_red.svg" style="float: left; padding-right: 100px" class="navLogo">
								<p><h4 class="modal-title">Login</h4></p>
						   <button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data" action="login.php">
								Username: <input type="text" name="uid" placeholder="Username or Email" class="form-control">
								Password: <input type="password" name="pwd" placeholder="Password" class="form-control">
							
								<div class="modal-footer">
									<input type="submit" name="submit" value="Login" class="form-control">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
							</form>
							
						  
						</div>
						
					  </div>

					  </div>
					</div>

				<!-- Modal2 -->
					<div id="myModal2" class="modal fade" role="dialog">
					  <div class="modal-dialog">

						  <!-- Modal content-->
					  <div class="modal-content">
						<div class="modal-header">
						<img src="images/logo_red.svg" style="float: left; padding-right: 100px" class="navLogo">
						  <h4 class="modal-title">Register</h4>
						   <button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data" action="register.php">
								Username: <input type="txt" name="uid" class="form-control">
								Password: <input type="txt" name="pwd" class="form-control">
								First name: <input type="text" name="fname" class="form-control">
								Last Name: <input type="text" name="lname" class="form-control">
								Email: <input type="text" name="email" class="form-control">
								Phone: <input type="text" name="phone" class="form-control">
								<p><hr></p>
								
								Dealer Name: <input type="text" name="dname" class="form-control">
								Dealer location: <input type="text" name="location" class="form-control">
								<p><hr></p>
								<P>Terms and conditions - Blahg blah blah</p>

							<!-- submit -->
								
									<div class="modal-footer">
									<input type="submit" name="submit" value="Register" class="form-control">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								
							</form>
					
						</div>
						
						

						  
						</div>
					  </div>

					  </div>
					</div>
				
			</div>
		</nav>
	</div>
		
	<div class="container">
		<h1>Wheelers & Dealers</h1>
		<p>Login</p>

	<!-- link Jquery, Bootstrap, and Popper.js -->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

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
		