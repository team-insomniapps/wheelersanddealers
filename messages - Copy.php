<?php
if(!isset($_SESSION)){ session_start(); }

	// database info
	$servername = "localhost";
	$dbname = "efftwelv_wheelersanddealers";
	$dsn = "mysql:host=$servername;dbname=$dbname";


	
	// if all fields are entered then proceed with connection to database 
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
	
		<?php
			$title = "Messages";
			include "head.php"; ?>
		
		<script type="text/javascript"> 
			
			function scrollToBottom(msgIDname) {
				var objDiv = document.getElementById(msgIDname);
				objDiv.scrollTop = objDiv.scrollHeight;
			}
			
		</script>
		
	
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		
		<?php 
				include('nav.php'); 
				
		?>
		
		
		<div class="container">
		
			<h1>My Messages</h1>
			
			<section class="col-sm-12">
					<!-- <article class="row carShortArticle col-sm-12"> -->
					<?php 
				
						// MySQL database query
						$queryID = "SELECT * FROM `messages` ";
						$queryID .= " INNER JOIN users ON messages.from_userID=users.id";
						$queryID .= " INNER JOIN vehicle ON messages.carID=vehicle.id";
						$queryID .= " WHERE to_userID=".$_SESSION['loginID'];
						$queryID .= " OR from_userID=".$_SESSION['loginID'];
						$queryID .= " ORDER BY parentID, msgDate ASC";
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){ die("Database query failed. "); }

						$msgID = null;
						while($row = mysqli_fetch_assoc($result)){
							
							if($row['parentID'] == $row['message_id'] and $msgID == null){
								echo "<section class='row col-sm-12 carShortInfo' >";
								require "message_Content.php";
								$msgID = $row['message_id'];
								echo "<article class='col-sm-6 msgShort' id='msgID".$msgID."'>";
							}
							else if($row['parentID'] == $row['message_id'] and $msgID != null){
								// close divs for previous message and start a new division
								echo "</article>";
								echo "</section>";
								
								echo "<script>scrollToBottom('msgID".$msgID."')</script>";
								
								echo "<section class='row col-sm-12 carShortInfo'>";
								require "message_Content.php";
								$msgID = $row['message_id'];
								echo "<article class='col-sm-6 msgShort' id='msgID".$msgID."'>";
							}
							
							
							if($row['to_userID'] == $_SESSION['loginID'] and $row['unread'] == 1){	
								echo "<p class='msgBuyerNew'><sub>{$row['customer_fname']} {$row['customer_lname']} {$row['msgDate']}</sub><br>";
								echo "{$row['message']}</p>";
								$queryRead = "UPDATE `messages` SET `unread` = '0' WHERE `messages`.`message_id` = {$row['message_id']}";
								mysqli_query($conn, $queryRead);
							}
							else if($row['from_userID'] == $_SESSION['loginID'])
							{
								echo "<p class='msgSeller'><sub>{$row['customer_fname']} {$row['customer_lname']} {$row['msgDate']}</sub><br>";
								echo "{$row['message']}</p>";
								
							}else{
								echo "<p class='msgBuyer'><sub>{$row['customer_fname']} {$row['customer_lname']} {$row['msgDate']}</sub><br>";
								echo " {$row['message']}</p>";
								
							}
							
							//echo "</div>";
							
							//require "message_Content.php";
							
						}
						
						if($msgID != null){
							echo "</article>";
							echo "</section>";
							echo "<script>scrollToBottom('msgID".$msgID."')</script>";
						}	
						echo "</div>";
					
						// release returned data
						mysqli_free_result($result);
							
						// close database connection
						mysqli_close($conn);
						 	
						
					?>
					<article>
					
				</section>
			
		</div>	
		
		
		
		<?php include('footer.php'); ?>

	</body>
</html>
