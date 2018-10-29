var data = { 
	
		UserPoolId : 'ap-southeast-2_lmX0a1XIT',
		ClientId : '5qts5daiuu5m8d82c443mk26jf'
	
	};
	
	var userPool = new AmazonCognitoIdentity.CognitoUserPool(data);
	var cognitoUser = userPool.getCurrentUser();
		
	window.onload = function(){
	if (cognitoUser != null) {
		cognitoUser.getSession(function(err, session) {
			if (err) {
				alert(err);
				return;
			}
			console.log('session validity: ' + session.isValid());
			//Set the profile info
			cognitoUser.getUserAttributes(function(err, result) {
				if (err) {
					console.log(err);
					return;
				}
				console.log(result);
				document.getElementById("email_value").innerHTML = result[2].getValue();	
				});			
			
			});
		}
	}
	
	if (cognitoUser != null) {
	  
		// hide login button 
		$('#logins').hide();

	}
	
	if (cognitoUser == null) {
	  
		// hide logout button 
		$('#logouts').hide();

	}