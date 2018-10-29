<?php

echo "<article class='col-sm-4'>";
echo "<form action='reply.php' method='post'>";
echo "<ul class='carInfoList'>";
echo "<li><h4 class='carTitle'>{$row['customer_fname']} {$row['customer_lname']}</h4></li>";
echo "<li><b>Dealership:</b> {$row['dealer_name']}</li>";
echo "<li><b>Location:</b> {$row['dealer_location']}</li>";
echo "<li><b>Vehicle:</b> {$row['car_make_id']} {$row['car_model_id']}</li>";
echo "<li><b>VIN:</b> {$row['car_vin']}</li>";
echo "<li><b>Rego:</b> {$row['vehicle_id']}</li>";
//echo "<li><b>Message:</b> {$row['message']}</li>";
echo "</ul>";


echo "<input type='hidden' name='messageID' value='{$row['message_id']}'>";
echo "<button type='submit' name='submit' value='submit' class='form-control'>reply</button>";


echo "</form>";
echo "</article>";

//echo "</section>";


?>