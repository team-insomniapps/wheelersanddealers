<?php
	session_start();
	
	
	$title = "Reply";
	require 'php/header.php';
	require 'conn.php';
	


	$msgID = null;
	$from_userID = null;
	$to_userID = null;

if(isset($_POST['submitReply'])){
	
		$toID = $_POST['toID'];
		$fromID = $_SESSION['loginID'];
		$carID = $_POST['carID'];
		$replyMessage = $_POST['replyMessage'];
		
		if(isset($_POST['messageID'])){
			$parentID = $_POST['messageID'];
		}else{
			$parentID = null;
		}
		
		try 
		{
			require "conn.php";
			
			if($parentID != null){
			// add a message to the message table
			$query_add_message = "INSERT INTO `messages` (`to_userID`, `from_userID`, `carID`, `message`, `parentID`) VALUES ( {$toID}, {$fromID}, {$carID}, '{$replyMessage}', {$parentID})"; 
			
				mysqli_query($conn, $query_add_message);
			}
			else{
			$query_add_message = "INSERT INTO `messages` (`to_userID`, `from_userID`, `carID`, `message`) VALUES ( {$toID}, {$fromID}, {$carID}, '{$replyMessage}')"; 
				
				mysqli_query($conn, $query_add_message);
				
				$parentID = mysqli_insert_id($conn);
				
				$query_add_parent = "UPDATE `messages` SET `parentID` = '$parentID' WHERE `messages`.`message_id` = $parentID"; 
			
				$_POST['parentMsg'] = $parentID;
				
				mysqli_query($conn, $query_add_parent);
			}
			
			
			
			
			// add all fields to all the tables
			
			
			
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
	
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php require 'php/navAccess.php' ?>
		
		<div class="container">
			<h1>Message</h1>
			<hr>
			<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			
				<div  class="row">
				
				<?php
					if(isset($_POST['submit'])){
						require "conn.php";
						
						// MySQL database query
						$queryID = "SELECT * FROM `vehicle` ";
						$queryID .= " INNER JOIN users ON vehicle.user_id=users.id";
						$queryID .= " WHERE car_vin='".$_POST['carVin']."'";
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){
								die("Database query failed.dfs ");
						}
						
						$row = mysqli_fetch_assoc($result);
						$from_userID = $_SESSION['loginID'];
						$to_userID = $row['user_id'];
						
						echo "<section class='row col-sm-12 carShortInfo' >";
								
						require "reply_message_Content.php";
						
						$queryID = "SELECT id FROM `vehicle` ";
						$queryID .= " WHERE car_vin='".$_POST['carVin']."'";
						
						$result = mysqli_query($conn, $queryID);
						$row = mysqli_fetch_assoc($result);
						
						$carID = $row['id'];
						
								
						echo "<article class='col-sm-8 msgLong' id='msgBox'>";
						
						
					}else{
						
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
								echo "<p class='msgBuyerNew'><sub>{$row['customer_login']} {$row['msgDate']}</sub><br>";
								echo "{$row['message']}</p>";
								$queryRead = "UPDATE `messages` SET `unread` = '0' WHERE `messages`.`message_id` = {$row['message_id']}";
								mysqli_query($conn, $queryRead);
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
		<?php 
			require 'php/logRegmodals.php';
		?>
		<div id="results"></div>
	
	
	<?php 
		require 'php/footer.php';
	?>
		
		
	</body>
</html>
