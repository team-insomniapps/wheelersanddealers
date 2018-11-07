<!-- Navigation access creation -->
<?php 
	
	If(isset($_SESSION['loginID'])){
		if($_COOKIE['access'] == ""){
			require 'php/nav_access_lvl_1.php';
			
		}elseif($_COOKIE['access'] == 0 || $_COOKIE['access'] == 1) {
			
			require 'php/nav_access_lvl_1.php';
			//echo "No Access";
			
		}elseif($_COOKIE['access'] == 2) {
			
			require 'php/nav_access_lvl_2.php';
			//echo "Dealer Level";
		
		}elseif($_COOKIE['access'] == 4) {
			
			require 'php/nav_access_lvl_1.php';
			//echo "Admin Level";
		}	
	}else {
		
		require 'php/nav_access_lvl_1.php';
	}
?>