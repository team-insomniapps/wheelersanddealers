<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<nav class="navbar navbar-expand-lg">
			<!-- branding logo image -->
			<a class="navbar-brand" href="index,php">
				<img src="images/logo_red.svg" class="navLogo">
			</a>
			<!-- collapse navigation to hamburger on small/mobile screens -->
			<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<!-- navigation bar -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
				<ul class="navbar-nav mr-auto mx-auto">
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
					<li class="nav-item"><a class="nav-link" href="about.php">Help</a></li>
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
		</nav>
