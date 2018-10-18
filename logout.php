<?php
session_start();

// code from http://php.net/session_destroy Example 1

	//unset all variables
	$_SESSION = array();

	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	// destroy session
	session_destroy();

//return user to home page
require "index.php";

?>