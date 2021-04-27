<?php
require_once('twitteroauth/OAuth.php');
require_once('twitteroauth/twitteroauth.php');
// define the consumer key and secet and callback
define('CONSUMER_KEY', 'NcHHQgOlZ5669A4Nx83slaOGU');
define('CONSUMER_SECRET', 'LjImKoLnUemMhW72hz22ju8L31lukma40lWsBwPhqP8xEB4415');
define('OAUTH_CALLBACK', 'http://localhost/twitter-login/twitter_callback.php');
// start the session
session_start();
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
