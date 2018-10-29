function signOut(){
	if (cognitoUser != null) {
		cognitoUser.signOut();
		location.reload();
	}
}