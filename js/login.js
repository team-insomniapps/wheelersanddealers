  function signInButton() {
				
	$('#myModal').modal('hide');	
	
	var authenticationData = {
		Username : document.getElementById("uid").value,
		Password : document.getElementById("pwd").value,
	};
	
	var authenticationDetails = new AmazonCognitoIdentity.AuthenticationDetails(authenticationData);
	
	var poolData = {
		UserPoolId : 'ap-southeast-2_lmX0a1XIT', // Your user pool id here
		ClientId : '5qts5daiuu5m8d82c443mk26jf', // Your client id here
	};
	
	var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);
	
	var userData = {
		Username : document.getElementById("uid").value,
		Pool : userPool,
	};
	
	var cognitoUser = new AmazonCognitoIdentity.CognitoUser(userData);
	
	cognitoUser.authenticateUser(authenticationDetails, {
		onSuccess: function (result) {
			var accessToken = result.getAccessToken().getJwtToken();
			console.log(accessToken);	
			location.reload();
			
		},

		onFailure: function(err) {
			//alert(err.message || JSON.stringify(err));
			alert("Incorrect Email or password.");
		},
	});
	
  }
  /*
  var email =  document.getElementById("uid").value;
	
	$.post('access.php', {postemail:email},
	function(data){
		
		// prints out post data -- need to be removed after data inserted into database as users.
		//$('#results2').html(data);
	});
	*/