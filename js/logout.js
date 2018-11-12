function signOut(){
	if (cognitoUser != null) {
		cognitoUser.signOut();
	}
	document.cookie = "access=;"
	document.location.href = "logout.php";
}