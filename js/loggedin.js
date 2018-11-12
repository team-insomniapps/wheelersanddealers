var send_access;

var data = { 
	
		UserPoolId : 'ap-southeast-2_lmX0a1XIT',
		ClientId : '5qts5daiuu5m8d82c443mk26jf'
	
	};
	
	var userPool = new AmazonCognitoIdentity.CognitoUserPool(data);
	var cognitoUser = userPool.getCurrentUser();
	send_access = 0;
	
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
				console.log(result[2].getValue());
				
				var address = result[2].getValue();
				$.post('php/access.php', {postaddress:address}, function(data){
						$('#results').html(data);
						
						if(data == 0){
							
							
						}
						
						if(data == 1){
							
							
						}
						
						if(data == 2){
							
							document.cookie = "access=2";
							
						}
						
						if(data == 3){
							
							
						}
						
						if(data == 4){
							
							document.cookie = "access=4";
							
							
						}
					});
				
				});			
				
			});
		}
	}
	
	if(cognitoUser != null) {
	// hide login button 
		$('#logins').hide();
		$('#reg').hide();
		var x = document.cookie;
		console.log(x);
		
	}
	
	if(cognitoUser == null){
		// hide logout button 
		$('#logouts').hide();
		//$('#profile').hide();
		$('#email_value').hide();
		//document.cookie = "access=0"
	}
	
	