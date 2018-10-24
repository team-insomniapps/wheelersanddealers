<?php
	session_start();

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
		// echo "Connection failed: " . $e->getMessage();
		echo "<script>alert('Connection failed: ')</script>";
	} 

if(isset($_POST['submitReply'])){
	
		$toID = $_POST['toID'];
		$fromID = $_SESSION['loginID'];
		$carID = $_POST['carID'];
		$replyMessage = $_POST['replyMessage'];
		
		try 
		{
			$conn = new PDO($dsn, $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			
			// add a vehicle to the vehicle table
			$query_add_message = "INSERT INTO `messages` (`to_userID`, `from_userID`, `carID`, `message`) VALUES ( {$toID}, {$fromID}, {$carID}, '{$replyMessage}')"; 
			echo "$query_add_message";
			// add all fields to all the tables
			$conn->beginTransaction();	
			$conn->exec($query_add_message);
			$conn->commit();
			
			// echo "Connected successfully"; 
			echo "<script>alert('Connected successfully')</script>";
			
			// not yet in the database structure
			// {$_POST['interiorColor']}', '{$_POST['condition']}', 
			
			// database not yet used in the form
			//
			
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
		
		
		
		<title>Wheelers & Deelers</title>
		
		
	</head>
		
	<body>
		<!-- Header/navigation bar div -->
		<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
		<?php include('nav.php'); ?>
		
		
		<div class="container">
			<h1>Messages</h1>
			<p>Reply</p>
			<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			
				<div  class="row">
				<div class="col-sm-6">
				<?php
				// MySQL database query
					if(isset($_POST['submitReply'])){
						echo "Message Sent.";
					}else{
							
						$queryID = "SELECT * FROM `messages` ";
						$queryID .= " INNER JOIN users ON messages.from_userID=users.id";
						$queryID .= " INNER JOIN vehicle ON messages.carID=vehicle.id";
						$queryID .= " WHERE message_id=".$_POST['messageID'];
						
						// echo "<script>alert('$queryID')</script>";
						
						$result = mysqli_query($conn, $queryID);
						
						// Test query error
						if(!$result){
								die("Database query failed. ");
						}
						
						
						$row = mysqli_fetch_assoc($result);
						
							require "reply_message_Content.php";
							
						
					
						// release returned data
						mysqli_free_result($result);
							
						// close database connection
						mysqli_close($conn);
					}
					?>
				<textarea name="replyMessage"></textarea>
				<input type="hidden" name="toID" value="<?php echo $row['from_userID'];?>">
				<input type="hidden" name="carID" value="<?php echo $row['carID'];?>">
				
				<!-- submit -->
				<div  class="form-group row">
					<div class="col-sm-6">
						<input type="submit" name="submitReply" value="submit" class="form-control">
						
					</div>
				</div>
				
			</div>
			</div>
			</form>
		</div>	
		
		<footer class="page-footer">
			<div class="footerTxt container-fluid text-left">
				<a class="footerTxt" href="#">Privacy Policy</a>
				<a class="footerTxt" href="#">Contact</a>
				<a class="footerTxt" href="#">Logout</a>
			</div>
		</footer>
		
	</body>
</html>
