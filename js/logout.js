function signOut(){
	if (cognitoUser != null) {
		cognitoUser.signOut();
	}
	document.cookie = "access=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"
	document.location.href = "logout.php";
}