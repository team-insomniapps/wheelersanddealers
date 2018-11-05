<!-- Header/navigation bar div -->
<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
        
<?php 

	if(isset($_SESSION['loginID']))
	{
		
		// Check for any new messages and set alert number next to mail icon button
		require "dbConnection.php";
		
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

?>
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
					<li class="nav-item"><a class="nav-link" href="add.php">Add</a></li>
					<li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
					<li class="nav-item"><a class="nav-link" href="match.php">Matches</a></li>
					<li class="nav-item"><a class="nav-link" href="inventory.php">Inventory</a></li>
					<li class="nav-item"><a class="nav-link" href="about.php">Help</a></li>
					
					<!--<li class="nav-item"><a class="nav-link" href="messages.php">Messages</a></li> -->
					
					<!-- 
					<li class="nav-item"><a class="nav-link" href="#">Account & Settings</a></li>
					-->
					
				</ul>
				
				
				<!-- login/logout button -->
				<div>
					<ul class="navbar-nav mr-auto mx-auto">
				
						<li>
							<a href="messages.php">
								<?php if( $newMsgs != 0){ 
									echo '<img src="images/mail.png" class="msgIcon">';
									echo '<span class="newMsgCount">'.$newMsgs.'</span>';
								}else{
									  echo '<img src="images/mail1.png" class="msgIcon">';
								    } 
								 ?>
							</a>
						</li>
						<li>
							<a class="logBtn btn btn-sm btn-outline-secondary"  href="logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>

		</nav>

<?php 
	}
	else{
		require('nav1.php');
	}
	?>
