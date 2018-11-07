<?php 
echo "<section class='row col-sm-12 carShortInfo' onclick= location.href='vehicle_info.php?car_vin={$row['car_vin']}' >";

//echo "<button type='button' class='btn btn-default' onclick= location.href='vehicle_match_info.php?car_vin={$row['car_vin']}' id=".htmlspecialchars($row['car_vin']).">View Vehicle</a>";

//echo "<a class='carLink' onclick= location.href='vehicle_info.php?car_vin={$row['car_vin']}' id=".htmlspecialchars($row['car_vin']).">";

echo "<article class='col-sm-6'>";
echo "<ul class='carInfoList'>";
echo "<li><h4 class='carTitle'>{$row['car_make_id']}";
echo " {$row['car_model_id']}<h3></li>";
echo "<li><h6>$ {$row['car_price']}</h6></li>";
echo "<li>Dealership: <b>{$row['dealer_name']}</b></li>";
echo "<li>Location: <b>{$row['dealer_location']}</b></li>";
echo "<li>Description: {$row['description']}</li>";
//echo "</a>";
//echo '<a class="carLink" href="carPage.php">';
echo "</article>";
echo "<aside class='col-sm-6'>";
echo '<img class="carPhoto" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>';

echo "</aside>";
//echo "</a>";
echo "</section>";
?>