<?php
	session_start();

	$msgID = null;
	$from_userID = null;
	$to_userID = null;
	
	// connect to database
	require "dbConnection.php";

if(isset($_POST['submitReply'])){
	
		$toID = $_POST['toID'];
		$fromID = $_SESSION['loginID'];
		$carID = $_POST['carID'];
		$replyMessage = $_POST['replyMessage'];
		$replyID = $_POST['messageID'];
		
		try 
		{
			$conn = new PDO($dsn, $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			
			// add a message to the message table
			$query_add_message = "INSERT INTO `messages` (`to_userID`, `from_userID`, `carID`, `message`, `parentID`) VALUES ( {$toID}, {$fromID}, {$carID}, '{$replyMessage}', {$replyID})"; 
			
			// add all fields to all the tables
			$conn->beginTransaction();	
			$conn->exec($query_add_message);
			$conn->commit();
			
			// echo "Connected successfully"; 
			// echo "<script>alert('Connected successfully')</script>";
			//header ("Location: reply.php");
			
		}
		catch(PDOException $e)
		{
			// echo "Connection failed: " . $e->getMessage();
			echo "<script>alert('Connection failed')</script>";
		} 
	
	}

	
	
	
	
?>


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
		
		<script src="js/message.js"></script>
		
		<title>Wheelers & Deelers</title>
		
		
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php include('nav.php'); ?>
		
		
		<div class="container">
			<h1>Message</h1>
			<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			
				<div  class="row">
				
				<?php
				// MySQL database query
					
						
						/*
						$queryID = "SELECT * FROM `messages` ";
						$queryID .= " INNER JOIN users ON messages.from_userID=users.id";
						$queryID .= " INNER JOIN vehicle ON messages.carID=vehicle.id";
						$queryID .= " WHERE message_id=".$_POST['messageID'];
*/


						// MySQL database query
						$queryID = "SELECT * FROM `messages` ";
						$queryID .= " INNER JOIN users ON messages.from_userID=users.id";
						$queryID .= " INNER JOIN vehicle ON messages.carID=vehicle.id";
						$queryID .= " WHERE parentID='".$_POST['parentMsg']."'";
						
						//$queryID .= " WHERE message_id=".$_POST['parentMsg'];

						$queryID .= " ORDER BY msgDate ASC";

						
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
						
						
						//$row = mysqli_fetch_assoc($result);
						
							//require "reply_message_Content.php";
						//require "message_Content.php";
						
						
						
						
						while($row = mysqli_fetch_assoc($result)){
							

							if($row['parentID'] == $row['message_id']){
								echo "<section class='row col-sm-12 carShortInfo' >";
								
								require "reply_message_Content.php";
								$msgID = $row['message_id'];
								$from_userID = $row['from_userID'];
								$to_userID = $row['to_userID'];
								$carID = $row['carID'];
								
								echo "<article class='col-sm-8 msgLong' id='msgBox'>";
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
						
						?>
						
						<textarea class="replyMsgTxt" name="replyMessage"></textarea>
					<input type="hidden" name="toID" value="<?php 
				
								if($from_userID == $_SESSION['loginID']){
									echo $to_userID;
								}else{
									echo $from_userID;
								}	
								?>">
								<input type="hidden" name="carID" value="<?php echo $carID;?>">
				<input type="hidden" name="parentMsg" value="<?php echo $_POST['parentMsg']?>">
				<!-- submit -->
				<div  class="form-group row">
						<input type="submit" name="submitReply" value="send" class="form-control">
						
				</div>
						</article>
					</section>
							<script>scrollToBottom('msgBox')</script>
						
					
							
							
						</div>
						
						<?php
						// release returned data
						mysqli_free_result($result);
							
						// close database connection
						mysqli_close($conn);
					
						
					
					?>
				
					
					
				
				
				
				
				
			</div>
			</div>
			</form>
		</div>	
		
		<?php include('footer.php'); ?>
		
	</body>
</html>
