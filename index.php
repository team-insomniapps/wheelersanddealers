<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Amazon Congnito Javascript SDK-->
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> 
		<script src="js_cognito/amazon-cognito-auth.min.js"></script>
		<script src="https://sdk.amazonaws.com/js/aws-sdk-2.7.16.min.js"></script> 
		<script src="js_cognito/amazon-cognito-identity.min.js"></script>  
		<script src="js_cognito/config.js"></script>
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/wheelers.css">
		
		<!-- link Jquery, Bootstrap, and Popper.js -->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<!-- Google fonts -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">

		<title>Wheelers & Deelers</title>
		
		<script>

			var username;
			var password;
			var personalname;
			//var phone;
			var poolData;
			
				
		  function registerButton() {
			
			personalnamename =  document.getElementById("personalnameRegister").value;	
			username = document.getElementById("emailInputRegister").value;
			// for phone verification later
			//phone = document.getElementById("phoneInputRegister").value;
			
			if (document.getElementById("passwordInputRegister").value != document.getElementById("confirmationpassword").value) {
				alert("Passwords Do Not Match!")
				throw "Passwords Do Not Match!"
			} else {
				password =  document.getElementById("passwordInputRegister").value;	
			}
			
			poolData = {
					UserPoolId :'ap-southeast-2_lmX0a1XIT', // Your user pool id here
					ClientId : '5qts5daiuu5m8d82c443mk26jf', // Your client id here
				};		
			var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);

			var attributeList = [];
			
			var dataEmail = {
				Name : 'email', 
				Value : username, //get from form field
			};
			
			var dataPersonalName = {
				Name : 'name', 
				Value : personalname, //get from form field
			};
			
			/*
			var dataPhoneNumber = {
				Name : 'phone_number', 
				Value : phone, //get from form field
			};
			*/

			var attributeEmail = new AmazonCognitoIdentity.CognitoUserAttribute(dataEmail);
			var attributePersonalName = new AmazonCognitoIdentity.CognitoUserAttribute(dataPersonalName);
			//var attributePhoneNumber = new AmazonCognitoIdentity.CognitoUserAttribute(dataPhoneNumber);
			
			attributeList.push(attributeEmail);
			attributeList.push(attributePersonalName);
			//attributeList.push(attributePhoneNumber);
			
			userPool.signUp(username, password, attributeList, null, function(err, result){
				if (err) {
					alert(err.message || JSON.stringify(err));
					return;
				}
				//cognitoUser = result.user;
				//console.log('user name is ' + cognitoUser.getUsername());
				//change elements of page
				window.location = 'https://52.63.106.64/wheelersanddealers/index2.php';
				//document.getElementById("titleheader").innerHTML = "Check your email for a verification link";
			});
		  }

	</script>
		

	</head>
		
	<!-- Header/navigation bar div -->
	<!-- https://getbootstrap.com/docs/4.0/components/navbar/? -->
	<nav class="navbar navbar-expand-lg">
		
		<!-- branding logo image -->
		<a class="navbar-brand" href="index.php">
			<img src="images/wdlogo.svg" class="navLogo d-inline-block align-top">
		</a>
		
		<!-- collapse navigation to hamburger on small/mobile screens -->
		<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<!-- navigation bar -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
			<ul class="navbar-nav mr-auto mx-auto">
				<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="add.php">Add</a></li>
				<li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
				<li class="nav-item"><a class="nav-link" href="match.php">Matches</a></li>
				<li class="nav-item"><a class="nav-link" href="inventory.php">Inventory</a></li>
				<li class="nav-item"><a class="nav-link" href="messages.php">Messages</a></li>
				<!--
				<li class="nav-item"><a class="nav-link" href="#">Account & Settings</a></li>
				-->
				<li class="nav-item"><a class="nav-link" href="about.php">Help</a></li>
			</ul>
					
			<!-- login button -->
			<div>
				<button type="button" class="btn btn-secondary btn-sm"  href="index_log.php">Login</button>
				<button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#myModal2">Register</button>
			</div>
		</div>

	</nav>
		
	<body>		
		<div class="container">
			<div class="jumbotron">
				<h1 class="display-4">Wheelers & Dealers</h1>
				<p class="lead">Lets make deals on your wheels</p>
				<p>Welcome to Wheelers and Dealers, the exclusive car matchmaking and exchange sevice.
				Wheelers and Dealers is an online Web application, that maintains your list of vehicles
				that you want to buy, sell or trade with other dealers or customers.</p>
				
				
				
				<p>If you have a vehicle that you want to sell, buy or trade. Wheelers and Dealers will put you in  our network of dealers that would like to buy your car. </p>
				<a class="btn btn-primary btn-lg" href="#" role="button">Get Started</a>
			</div>
			
			<!-- Modal2 = register -->
			<div id="myModal2" class="modal fade" role="dialog">
				<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<img src="images/logo_red.svg" style="float: left; padding-right: 30px" class="navLogo">
						<h4 class="modal-title">Register an Account</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<p>Username<input type="personalname" class="form-control" id="personalnameRegister" placeholder="Username" pattern=".*" required></p>
						<p>Email<input type="email" class="form-control" id="emailInputRegister" placeholder="Email" pattern=".*" required></p>
						<p>Phone<input type="phone" class="form-control" id="phoneInputRegister" placeholder="Phone" pattern=".*" required></p>
						
						<p>Password<input type="password" class="form-control" id="passwordInputRegister" placeholder="Password" pattern=".*" required></p>
						<p>Confirm Password<input type="password" class="form-control" id="confirmationpassword" placeholder="Confirm Password" pattern=".*" required></p>
	
						<div class="modal-footer">
							<button id="mainbutton" class="btn btn-lg btn-primary btn-block" type="button" onclick="registerButton()" >Register</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						</div>
					</div>
				</div>
			</div>
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
