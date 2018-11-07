<?php

if(isset($row['from_userID'])){
	$sellerID = $row['from_userID'];
}else{
	$sellerID = $row['user_id'];
}

echo "<article class='col-sm-4'>";
echo "<form action='reply.php' method='post'>";
echo "<ul class='carInfoList'>";

echo "<li><h4 class='carTitle'>";

if($sellerID == $_SESSION['loginID']){ 
	
	echo "To: {$row['customer_login']}</li>";
	
} else {

	echo "From: {$row['customer_login']}</li>";

}

echo "<li><b>Dealership:</b> {$row['dealer_name']}</li>";
echo "<li><b>Location:</b> {$row['dealer_location']}</li><br>";

echo "<h6 class='msgTitle'>Regarding:</h6>";
echo "<li><b>Vehicle:</b> {$row['car_make_id']} {$row['car_model_id']}</li>";
echo "<li><b>Price: $</b> {$row['car_price']}</li>";
echo "<li><b>VIN:</b> {$row['car_vin']}</li>";
echo "<li><b>Rego:</b> {$row['vehicle_id']}</li>";
//echo "<li><b>Message:</b> {$row['message']}</li>";
echo "</ul>";

if(isset($row['message_id'])){
	echo "<input type='hidden' name='messageID' value='{$row['message_id']}'>";
}

echo "</form>";
echo '<img class="carPhotoMsg" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';
echo "</article>";


?>