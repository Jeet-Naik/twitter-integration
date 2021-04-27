<?php
require_once('twitteroauth/OAuth.php');
require_once('twitteroauth/twitteroauth.php');
// define the consumer key and secet and callback
define('CONSUMER_KEY', 'NcHHQgOlZ5669A4Nx83slaOGU');
define('CONSUMER_SECRET', 'LjImKoLnUemMhW72hz22ju8L31lukma40lWsBwPhqP8xEB4415');
define('OAUTH_CALLBACK', 'http://localhost/twitter-login/twitter_callback.php');
// start the session
session_start();