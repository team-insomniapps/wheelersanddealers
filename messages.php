<?php
	session_start();
	
	$title = "Messages";
	
	require 'php/header.php';
	require 'conn.php';
?>

<!doctype html>
<html lang="en">
	<head>
		
		<script src="js/message.js"></script>
		
	
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php require 'php/navAccess.php' ?>
		
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
								echo "<p class='msgBuyerNew'><sub>{$row['customer_login']} {$row['msgDate']}</sub><br>";
								echo "{$row['message']}</p>";
								
							}
							else if($row['from_userID'] == $_SESSION['loginID'])
							{
								echo "<p class='msgSeller'><sub>{$row['customer_login']} {$row['msgDate']}</sub><br>";
								echo "{$row['message']}</p>";
								
							}else{
								echo "<p class='msgBuyer'><sub>{$row['customer_login']} {$row['msgDate']}</sub><br>";
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
		
		<!-- Modal -->
		<?php 
			require 'php/logRegmodals.php';
		?>
		<?php include('php/footer.php'); ?>

	</body>
</html>
