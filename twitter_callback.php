<?php
// Load the configuration files
require_once('config.php');
// 3. if its a callback url
if(isset($_GET['oauth_token']) &&isset($_GET['oauth_verifier']) ){
	$_SESSION['oauth_verifier']=$_GET['oauth_verifier'];
	$_SESSION['oauth_token']=$_GET['oauth_token'];

}

// create a new twitter connection object with request token
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
// get the access token from getAccesToken method
$access_token = $connection->getAccessToken($_SESSION['oauth_verifier']);
if($access_token){	
	// create another connection object with access token
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	// set the parameters array with attributes include_entities false
	$params =array('include_entities'=>'false');
	// get the data
	$data = $connection->get('account/verify_credentials',$params);
	if($data){
		// store the data in the session
		// echo the name username and photo
		echo "Name : ".$data->name."<br>";
		echo "Username : ".$data->screen_name."<br>";
		echo "Photo : <img src='".$data->profile_image_url."'/><br><br>";
		// echo the logout button
		echo "<a href='logout.php'><button>Logout</button></a>";

		require 'get_tweets.php';  
	}
}
