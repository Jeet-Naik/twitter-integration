<?php
// Load the configuration files
require_once('config.php');

/* 
 * PART 2 - PROCESS
 * 1. check for logout
 * 2. check for user session  
 * 3. check for callback
 */

// 1. to handle logout request
if(isset($_GET['logout'])){
	//unset the session
	session_unset();
	// redirect to same page to remove url paramters
	$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}


// 2. if user session not enabled get the login url
if(!isset($_SESSION['data']) && !isset($_GET['oauth_token'])) {
	// create a new twitter connection object
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

	// get the token from connection object
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK); 

	// if request_token exists then get the token and secret and store in the session
	if($request_token){
		$token = $request_token['oauth_token'];
		$_SESSION['request_token'] = $token ;
		$_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
		// get the login url from getauthorizeurl method
		$login_url = $connection->getAuthorizeURL($token);
	}
}

/* 
 * PART 3 - FRONT END 
 *  - if userdata available then print data
 *  - else display the login url
*/
if(isset($login_url)){
	// echo the login url
	echo "<a href='$login_url'><button>Login with twitter </button></a>";
}



