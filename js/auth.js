var usernames;
var passwords;
var personalname;
//var phone;
var poolData;


function posts(){
	 
	// close model 
	$('#myModal2').modal('hide');	
	
	// connect user to aws cognito for email adress validation
	// phone validation is ready to be implemented.
	personalnamename =  document.getElementById("names").value;	
	usernames = document.getElementById("email").value;
	// for phone verification later
	//phone = document.getElementById("phoneInputRegister").value;
	
	if (document.getElementById("password").value != document.getElementById("confirmpassword").value) {
		alert("Passwords Do Not Match!")
		throw "Passwords Do Not Match!"
	} else {
		password =  document.getElementById("password").value;	
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
	
	userPool.signUp(usernames, password, attributeList, null, function(err, result){
		if (err) {
			alert(err.message || JSON.stringify(err));
			return;
		}
		cognitoUser = result.user;
		console.log('user name is ' + cognitoUser.getUsername());
		   
		
	});
	
	// post variables to database via index2.php
	var username = $('#names').val();
	var emails = $('#email').val();
	var phones = $('#phone').val();
	var pass = $('#password').val();
	var conpass = $('#confirmpassword').val();
	var dealname = $('#dealername').val();
	var dealloc = $('#dealerlocation').val();
	
	$.post('php/register_process.php', {postname:username, postemail:emails, postphone:phones,
	postpass:pass, postconpass:conpass,postdn:dealname, postdl:dealloc},
	function(data){
		
		// prints out post data -- need to be removed after data inserted into database as users.
		//$('#results').html(data);
	});
	
  }