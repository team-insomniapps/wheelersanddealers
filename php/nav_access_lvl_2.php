<?php 

	if(isset($_SESSION['loginID']))
	{
		
		// Check for any new messages and set alert number next to mail icon button
		require "conn.php";
		
		// MySQL database query
			$queryRecords = "SELECT COUNT(`to_userID`) FROM `messages` ";
			$queryRecords .= "WHERE to_userID=".$_SESSION['loginID']. " AND unread=1";
			$result = mysqli_query($conn, $queryRecords);
			
			// Test query error
			if(!$result){ die("Database query failed. "); }
			
			while($row = mysqli_fetch_assoc($result)){	
				$newMsgs = $row['COUNT(`to_userID`)']; }
			
			// release returned data
			mysqli_free_result($result);
	}
?>

<!-- Header/navigation bar div -->
<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
<nav class="navbar navbar-expand-lg">
	
	<!-- branding logo image -->
	<a class="navbar-brand" href="index.php">
		<img src="images/wdlogo.svg" class="navLogo d-inline-block align-top">
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
			<div class="dropdown">
				<label class="nav-link">Vehicles</label>
				<div class="dropdown-content">
					<div class="nav-link">
						<a href="add_vehicle.php">Add Vehicles</a>
						<a href="inventory.php">Inventory</a>
						<a href="match.php">Matches</a>
				</div>
				</div>
			</div>
			<div class="dropdown">
				<label class="nav-link">Contact</label>
				<div class="dropdown-content">
					<div class="nav-link">
						<a href="aboutus.php">About Us</a>
						<a href="contactus.php">Contact Us</a>
						
				</div>
				</div>
			</div>
		</ul>
			<?php if(isset($_SESSION['loginID'])){
				
					echo '<a href="messages.php">';
					if( $newMsgs != 0){ 
						echo '<img src="images/mail.png" class="msgIcon">';
						echo '<span class="newMsgCount">'.$newMsgs.'</span>';
					}else{
						  echo '<img src="images/mail1.png" class="msgIcon">';
						} 
					 
					echo '</a>';
				}
			?>
		
		<!-- login button -->
		<!-- <div id="profile" class="btn btn-secondary btn-sm">Profile</div> -->
		<div id="email_value"></div>
		<div>
			
			<button id="logins" type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myModal">Login</button>
			<button type="button" id="logouts" class="btn btn-secondary btn-sm" onclick="signOut()">Logout</button>
			<button id="reg" type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#myModal2">Register</button>
		</div>		
	</div>
</nav>