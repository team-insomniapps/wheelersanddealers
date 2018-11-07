<?php

echo "<article class='col-sm-4'>";
echo "<form name='msg{$row['message_id']}' action='reply.php' method='post'>";
echo "<ul class='carInfoList'>";

echo "<li><h5 class='msgTitle'>";

// get the name of the person the message was sent to.
if($row['from_userID'] == $_SESSION['loginID']){ 
	
	$queryUserName = "SELECT * FROM `users` ";
	$queryUserName .= " WHERE id=".$row['to_userID'];
	$userName = mysqli_fetch_assoc(mysqli_query($conn, $queryUserName));

	echo "To: {$userName['customer_login']}";
	
} 


else{echo "From: {$row['customer_login']}";}

echo "</h6></li>";

//echo "<li><b>Dealership:</b> {$row['dealer_name']}</li>";
//echo "<li><b>Location:</b> {$row['dealer_location']}</li>";

echo "<h6 class='msgTitle'>Regarding:</h6>";
echo "<li><b>Vehicle:</b> {$row['car_make_id']} {$row['car_model_id']}</li>";
//echo "<li><b>VIN:</b> {$row['car_vin']}</li>";
echo "<li><b>Rego:</b> {$row['vehicle_id']}</li>";
//echo "<li><b>Message:</b> {$row['message']}</li>";


echo "</ul>";


echo "<input type='hidden' name='parentMsg' value='{$row['parentID']}'>";
echo "<button type='submit' name='submit{$row['message_id']}' value='submit' class='msgReplyBtn btn btn-sm btn-outline-secondary'>reply</button>";


echo "</form>";
echo "</article>";

//echo "</section>";


?>