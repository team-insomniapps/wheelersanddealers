<?php
/*
*	php code to check if form has been submitted.
*	If true, then connect to the database and input the data.
*
*
*/
// database info
$servername = "localhost";
$dbname = "efftwelv_wheelersanddealers";
$dsn = "mysql:host=$servername;dbname=$dbname";


// if(!(isset($_POST['submit'])))
// {
// 	echo"<script>alert('Submission failure'</script>";
// 	exit;
// }

$posted_array = array();
$posted_array = $_POST;

$post_array_complete = true;

//option two return specific unfilled values back to user

// $unfilled_post_values = array();
// foreach($posted_array as $key => $ value)
// {
//
// 	$unfilled_post_array($key => 'true';)
// }


//check if each key is a value, trim whitespace
foreach($posted_array as $key => $value)
{
	if(!(isset($key)))
	{
		$post_array_complete = false;
		break;
	}
	// option two return specific unfilled values back to user
//	if(!(isset($key)))
		// {
		// 	$unfilled_post_array($key => 'false');
		//  echo <script>aler('Please enter a value for "$key"')</script>;
		// }

	$value = trim($value);
}
if($post_array_complete == false)
{
		// echo "<script>alert('Please enter all fields')</script>";
		// option two
		// foreach($unfilled_post_array as $key => value)
		// {
		//		echo <script>alert('Please enter a value for $key\n')</script>
		//}
}

$post_array_valid = false;
$sanitized_post_array = array();
$sanitized_post_array = $posted_array;
$validated_post_array = array();

//Removes  potentially nastycode
$sanitize_args = array('filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);

foreach($posted_array as $key => $value)
{
	//can add additional flags and/or filters if we need to
			//strip high (above numerical value 127, strip low below numerical/ASCII 32, etc)
	foreach($sanitize_args as $arg_value)
	{
		$sanitized_post_array[$key] = filter_var($value,$arg_value);
	}
}

//regex test for condition value
	// proof of concept/test will make more universal to suit other data fields
$possible_conditions = array('new','used');
$regex_array_count = count($possible_conditions);
//$condition_regex = "/^(new|used)$/";
$condition_regex = "/^(";

foreach($possible_conditions as $key => $value)
{

	if($key < ($regex_array_count - 1))
	{
		$condition_regex = $condition_regex.$value."|";
	}
	else
	{
			$condition_regex = $condition_regex.$value;
	}
}
$condition_regex = $condition_regex.")$/";

// for testing
// echo "<h3> regex is </h3>";
// var_dump($condition_regex);
// var_dump($regex_array_count);

//validates values according to specific field/data type filter, will return false if any is empty
		//will need to get more regexes from database colour, model, etc
$validate_args = array(
							'vin'		=>	array('filter' => FILTER_VALIDATE_REGEXP,
											'options' => array('regexp' => "/^((([A-H]|J|N|P|[R-Z]){1})|([0-9]{1})){17}$/")
																),
							'year'	=>	array('filter' => FILTER_VALIDATE_INT,
																'options' => array ('min_range' => '1920', 'max_range' => '2020')
																),
							'make'	=>	array('filter' => FILTER_SANITIZE_STRING && FILTER_FLAG_STRIP_HIGH),
							'model'	=>	array('filter' => FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS, 'flags' => FILTER_FLAG_STRIP_HIGH),
							'exteriorColor'	=>	array('filter' => FILTER_VALIDATE_REGEXP,
												'options' => array('regexp' => "/^(A-Z]|\s){1,24}$/")),
							'conditions'	=> array('filter' => FILTER_VALIDATE_REGEXP,
												'options' => array('regexp' => "$condition_regex")
																	),
							'bodyStyle'	=>	array('filter' => FILTER_VALIDATE_REGEXP,
												'options' => array('regexp' => "/^(A-Z]|\s){1,24}$/")),
							'transmission'	=>	array('filter' => FILTER_VALIDATE_REGEXP,
												'options' => array('regexp' => "/^(A-Z]|\s){1,24}$/")),
							'drivetrain'	=>	array('filter' => FILTER_VALIDATE_REGEXP,
												'options' => array('regexp' => "/^(A-Z]|\s){1,24}$/")),
							'cylinders'	=>	array('filter' => FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT, FILTER_SANITIZE_FULL_SPECIAL_CHARS,
														'options' => array('min_range' => '2', 'max_range' => '12')
															),
							'mileage'	=>	FILTER_VALIDATE_INT, //FILTER_SANITIZE_NUMBER_INT,
							'fuel'	=> array('filter' => FILTER_VALIDATE_REGEXP,
												'options' => array('regexp' => "/^(A-Z]|\s){1,24}$/")), //needs better regex
							'doors'	=>	FILTER_VALIDATE_INT, //FILTER_SANITIZE_NUMBER_INT,
							'passengerCapacity' => array('filter' => FILTER_VALIDATE_INT, 'options' => array('min_range' => '2', 'max_range' => '6')),   //	array('filter' => FILTER_VALIDATE_INT | FILTER_SANITIZE_NUMBER_INT),
							'interiorColor'	=>	array('filter' => FILTER_VALIDATE_REGEXP,
												'options' => array('regexp' => "/^(A-Z]|\s){1,24}$/")), //needs better regex
							'rego'	=>	array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array(
							'regexp' => "/^([A-Z]{2,6})|([A-Z]{3}-[0-9]{3})|([A-Z]{2}-[0-9]{2}-[A-Z]{2})$/")
																),
							'description'	=>	array('filter' => FILTER_VALIDATE_REGEXP,
												'options' => array('regexp' => "/^(A-Z]|\s){1,200}$/")), //needs better regex, max chars, can be empty??
							'price'	=>	array('filter' => FILTER_VALIDATE_REGEXP && FILTER_SANITIZE_NUMBER_FLOAT && FILTER_VALIDATE_FLOAT, 'options' => array(
							'regexp' => "/^([0-9]{1,6}?.[0-9]{1,2})?$/")
																)
);


$validated_post_array = filter_var_array($sanitized_post_array,$validate_args);
// echo "<h3> validated post arry in loop is <br></h3>";
foreach($validated_post_array as $key => $value)
{
	if($value == false)
	{
			// echo "<script>alert('Form contains invalid data')</script>";
			//break;   for testing will need to include in final
	}
	if ($value == NULL)
	{
		//not sure if earlier checks cover this, mainly so code doesn't just stop
		//echo"<script>alert('Form contains empty data')</script>";
		//break;   for testing will need to include in final
	}
	// var_dump($key);
	// var_dump($value);
	//echo "<p> Value is $value <br></p>";
}
//fortesting
/* echo "<h3> posted array is ".$value."<br></h3>";
	foreach($posted_array as $key => $value)
	{
		var_dump($key);
		var_dump($value);
		echo "<p> Value is $value <br></p>";
	}
	echo "<h3> validated_post_array is ".$value."<br></h3>";
	var_dump($validated_post_array);
	
	 */
//end for testing

	// if all fields are entered and validate then proceed with connection to database
	// connect to database
	$username = "efftwelv_andrew";
	$password = "Andrew1000";

	// variables to hold post information by form
	$vin = $validated_post_array['vin'];
	$year = $validated_post_array['year'];
	$make = $validated_post_array['make'];
	$model = $validated_post_array['model'];
	$ex_color = $validated_post_array['exteriorColor'];
	$conditions = $validated_post_array['conditions'];
	$body_style = $validated_post_array['bodyStyle'];
	$transmission = $validated_post_array['transmission'];
	$drivetrain = $validated_post_array['drivetrain'];
	$cyclinders = $validated_post_array['cylinders'];
	$mileage = $validated_post_array['mileage'];
	$fuel = $validated_post_array['fuel'];
	$doors = $validated_post_array['doors'];
	$passenger_capacity = $validated_post_array['passengerCapacity'];
	$in_color = $validated_post_array['interiorColor'];
	$regos = $validated_post_array['rego'];
	$desc = $validated_post_array['description'];
	$price = $validated_post_array['price'];

	try
	{
		$conn = new PDO($dsn, $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		// add a vehicle to the vehicle table
		$query_add_vehicle = "INSERT INTO `vehicle` (`car_vin`, `car_year`, `car_make_id`, `car_model_id`,
													 `car_exterior_color`, `car_new_used_condition`,
													 `car_body_type_id`, `car_transmission_type_id`,
													 `car_drive_type`, `car_engine_size`, `car_kilometers`,
													 `car_fuel_type`, `car_num_doors`, `car_capacity`,
													 `car_interior_color`, `vehicle_id`,`description`, `car_price`)
							  VALUES ('{$vin}',{$year}, '{$make}', '{$model}', '{$ex_color}', '{$conditions}',
							  '{$body_style}','{$transmission}', '{$drivetrain}', {$cyclinders}, {$mileage},'{$fuel}',
								  {$doors}, '{$passenger_capacity}','{$in_color}','{$regos}','{$desc}', {$price})";

		// add the transmission type to the car_transmission_types table
		$query_add_transmission = "INSERT INTO `car_transmission_types` (`name`) VALUES ('{$transmission}')";

		// add the body type to the car_body_types table
		$query_add_body_types = "INSERT INTO `car_body_types` (`name`) VALUES ('{$body_style}')";

		// add the make to the car make table
		$query_add_car_make = "INSERT INTO `car_make` (`car_make_name`) VALUES ('{$make}')";

		// add the model to the car model table
		$query_add_car_model = "INSERT INTO `car_models` (`car_make_id`,`name`) VALUES ('{$make}','{$model}')";

		// add the vehicle id to the car_photos table ** Note car_photo blob is null
		$query_add_car_photos = "INSERT INTO `car_photos` (`vehicle_id`, `car_description`) VALUES ('{$regos}','{$desc}')";

		// echo '<script>alert("' . $query . '");</script>';


		// add all fields to all the tables
		$conn->beginTransaction();
		$conn->exec($query_add_transmission);
		$conn->exec($query_add_body_types);
		$conn->exec($query_add_car_make);
		$conn->exec($query_add_car_model);
		$conn->exec($query_add_car_photos);
		$conn->exec($query_add_vehicle);
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
		echo "<script>alert('Connection failed: ')</script>";
	} 



?>