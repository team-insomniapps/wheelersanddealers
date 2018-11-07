<!doctype html>
<html lang="en">
<?php 
	require 'php/header.php';
	require 'conn.php';
?>
	
	<body>
	<!-- nav bar -->
	<?php require 'php/navAccess.php' ?>	
		
		
	<div class="container">
			<div class="col-sm-6">
				<h4>Contact Us</h4><hr>
				<h1>Wheelers & Dealers</h1>
				</br><i><h3>Thanks you, your form has been submitted. Please allow a couple of years before we get back to you.</h3></i>
				</br><input type="button" class="btn btn-secondary btn-sm" value="Back to Home" class="form-control">
			
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
						<form>
							Username: <input type="text" id="uid" placeholder="Username or Email" class="form-control">
							Password: <input type="password" id="pwd" placeholder="Password" class="form-control">
							
							<div class="modal-footer">
								<input type="button" value="Login" class="btn btn-secondary btn-block" onclick="signInButton()" class="form-control">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>	
		<!-- Modal2 = register -->
			<div id="myModal2" class="modal fade" role="dialog">
				<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<img src="images/logo_red.svg" style="float: left; padding-right: 30px" class="navLogo">
						<h4 class="modal-title">Register an Account</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				<div class="modal-body">
					<form>
						<p>Username<input type="personalname" class="form-control" id="names" placeholder="Username"></p>
						<p>Email<input type="personalemail" class="form-control" id="email" placeholder="Email" ></p>
						<p>Phone<input type="personalphone" class="form-control" id="phone" placeholder="Phone" ></p>
						<p>Password<input type="password" class="form-control" id="password" placeholder="Password"></p>
						<p>Confirm Password<input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" ></p>
						<hr>
						<p>Dealers Name<input type="Dealername" class="form-control" id="dealername" placeholder="Dealers Name"></p>
						<p>Dealers Location <input type="Dealerlocation" class="form-control" id="dealerlocation" placeholder="Dealers Location"></p>
						<div class="modal-footer">
							<button name="submit" class="btn btn-lg btn-primary btn-block" type="button" onclick="posts()"  >Register</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
				</div>
				</div>
			</div>
		<div id="results"></div>
	
	</div>
		<!-- checks to see if client is logged in via AWS -->
		<script type="text/javascript" src="js/loggedin.js"></script>
		
		<!-- login to AWS -->
		<script type="text/javascript" src ="js/login.js"></script>
		
		<!-- Register to login to AWS -->
		<script type="text/javascript" src="js/auth.js"></script>
		
		<!-- Logout  -->
		<script type="text/javascript" src="js/logout.js"></script>
		
		<footer class="page-footer">
		<div class="footerTxt container-fluid text-left">
			<a class="footerTxt" href="#">Privacy Policy</a>
			<a class="footerTxt" href="#">Contact</a>
			<a class="footerTxt" href="#">Logout</a>
		</div>
		
		<
	</footer>
	
 </body>  
</html>
