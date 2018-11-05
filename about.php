<?php
session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<?php
			$title = "about";
			include "head.php"; ?>
		
	</head>

	<body>		
		<div class="container">
			<?php include('nav.php'); ?>
		
			<h1>Pages</h1>
			<p><a href="vehicle_info.php">vehicle_info.php</a></p>
			<p><a href="vehicle_match_info.php">vehicle_match_info.php</a></p>
			<p><a href="inventory.php">inventory.php</a></p>
			<p><a href="index.php">index.php</a></p>
			<p><a href="vehicle_info_test.php">vehicle_info_test.php</a></p>
			<p><a href="testlogin.php">testlogin.php</a></p>
			<p><a href="search_results.php">search_results.php</a></p>
			<p><a href="search.php">search.php</a></p>
			<p><a href="preferences.php">preferences.php</a></p>
			<p><a href="match_test.php">match_test.php</a></p>
			<p><a href="match.php">match.php</a></p>
			<p><a href="add.php">add.php</a></p>
			<p><a href="testlogin.php">testlogin.php</a></p>
			
			
			
			<?php include('footer.php'); ?>
		</div>
	</body>

</html>
