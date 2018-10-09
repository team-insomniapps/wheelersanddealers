<!-- Header/navigation bar div -->
<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
<nav class="navbar navbar-expand-lg">
	<!-- branding logo image -->
	<a class="navbar-brand" href="index.php">
	<img src="images/wdlogo.svg" class="navLogo">
	</a>
	<!-- collapse navigation to hamburger on small/mobile screens -->
	<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>

	<!-- navigation bar -->
	<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
		<ul class="navbar-nav mr-auto mx-auto">
			<li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
			<li class="nav-item"><a class="nav-link" href="#">About</a></li>
			<li class="nav-item"><a class="nav-link" href="#">Register</a></li>
			<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
		</ul>
		<!-- login button -->
		<div>
			<button type="button" class="btn btn-secondary btn-sm"  href="index_log.php">Login</button>
			<button type="button" class="btn btn-primary btn-sm"  href="#"">Register</button>
		</div>
	</div>

</nav>