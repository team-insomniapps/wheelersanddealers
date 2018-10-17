<!-- Header/navigation bar div -->
<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->

<?php 

	if(isset($_SESSION['login'])) {}
	else {
		$_SESSION['login'] = false;
    }

	
	if(($_SESSION['login']) == 'true')
	{
	?>
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
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="add.php">Add</a></li>
					<li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
					<li class="nav-item"><a class="nav-link" href="match.php">Matches</a></li>
					<li class="nav-item"><a class="nav-link" href="inventory.php">Inventory</a></li>
					
					
					<!-- <li class="nav-item"><a class="nav-link" href="#">Messages</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Account & Settings</a></li>
					-->
					<li class="nav-item"><a class="nav-link" href="about.php">Help</a></li>
				</ul>
					
					
				</ul>
				<!-- login/logout button -->
				<div>
					<a class="logBtn btn btn-sm btn-outline-secondary"  href="index.php">Logout</a>
				</div>
			</div>
		</nav>
		
	<?php 
	}
	else{
		require('nav1.php');
	}
	?>