<?php session_start(); ?>
<!doctype html>
<html lang="en">
<?php 
	$title = "Contact Us";
	require 'php/header.php';
	require 'conn.php';
	
?>
	
	<body>
		
		<!-- nav bar -->
		<?php require 'php/navAccess.php' ?>
		
	<div class="container">
			<div class="col-sm-12">
				<h4>Contact Us</h4><hr>
				<h1>Wheelers & Dealers</h1>
				<p><h5>Hello There<hr id="under"></h5><p>
				<p>Feel free to contact us, we are always open to discussing any feedback or issues you might have with our platform.</p>
				<p>Thanks in advance</br><i>Team InsomniApps<i></p>
				<div class="row">
					<form method="post" name="myemailform" action="form_email.php">
						<input type="text" name="name" class="form-control" placeholder="Name"></br>
						<input type="text" name="email" class="form-control" placeholder="Email Address"></br>
						<textarea rows="10" cols="50" name="message" class="form-control" placeholder="Description of Feedback or Issues"></textarea></br>
						<input type="submit" value="Submit" class="btn btn-primary btn-sm" style="float: right;" class="form-control">
					</form>
				</div>
				</div>
				<hr>
			</div>
			<!-- Modal -->
		<?php 
			require 'php/logRegmodals.php';
		?>
		<div id="results"></div>
	<?php 
		require 'php/footer.php';
	?>
 </body>  
</html>
