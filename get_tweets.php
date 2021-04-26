<H1><?php echo $data->name; ?>'s Timeline</H1>
<?php
/**
 * Reference : https://blog.netgloo.com/2015/08/16/php-getting-latest-tweets-and-displaying-them-in-html/
 */
// Require J7mbo's TwitterAPIExchange library (used to retrive the tweets)
// url : https://github.com/J7mbo/twitter-api-php
require_once('vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');

// Set here your twitter application tokens
$settings = array(
    'consumer_key' => CONSUMER_KEY,
    'consumer_secret' => CONSUMER_SECRET,

    // These two can be left empty since we'll only read from the Twitter's 
    // timeline
    'oauth_access_token' => '',
    'oauth_access_token_secret' => '',
);

// Set here the Twitter account from where getting latest tweets
$screen_name = $data->screen_name;

// Get timeline using TwitterAPIExchange
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = "?screen_name={$screen_name}";
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$user_timeline = $twitter
    ->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

//User tweets array
$user_timeline = json_decode($user_timeline);

//Format tweets to display
// Require our TwitterTextFormatter library
// Url: https://github.com/netgloo/php-samples/tree/master/php-twitter-text-formatter
require_once('TwitterTextFormatter.php');

// Use the class TwitterTextFormatter
use Netgloo\TwitterTextFormatter;

// Print each tweet using TwitterTextFormatter to get the HTML text
echo "<ul>";
foreach ($user_timeline as $user_tweet) {

    echo "<li>";
    echo TwitterTextFormatter::format_text($user_tweet);

    // Print also the tweet's image if is set
    if (isset($user_tweet->entities->media)) {
        $media_url = $user_tweet->entities->media[0]->media_url;
        echo "<img src='{$media_url}' width='100%' />";
    }

    echo "</li>";
}
echo "</ul>";
