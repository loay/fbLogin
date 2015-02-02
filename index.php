<?php
// Begin loading the necessary files for the Facebook SDK.
require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/HttpClients/FacebookCurl.php');
require_once('Facebook/HttpClients/FacebookHttpable.php');
require_once('Facebook/HttpClients/FacebookCurlHttpClient.php');
require_once('Facebook/Entities/AccessToken.php');
require_once('Facebook/GraphUser.php');
require_once('Facebook/GraphSessionInfo.php');

use Facebook\GraphSessionInfo;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\GraphUser;

// Start the session
session_start();

// Initialize the Facebook app using the application ID and secret.
FacebookSession::setDefaultApplication( 'INSERT APP ID','INSERT APP secret' );

// Define Facebook's login helper and redirect back to our page.
$helper = new FacebookRedirectLoginHelper( 'INDEX URL','INSERT APP ID','INSERT APP secret'  );

// Check to ensure our session was started correctly and the access token exists.
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
// Using the access token, create a new session.
$session = new FacebookSession( $_SESSION['fb_token'] );

// Determine if the defined session is indeed valid.
if ( !$session->validate() ) {
$session = null;
}
}
// Check if an active session exists.
if ( !isset( $session ) || $session === null ) {
// If no session exists, let's try to create one.
$session = $helper->getSessionFromRedirect();
}

// Make sure we have a session started.
if ( isset( $session ) ) {
// Save the session
$_SESSION['fb_token'] = $session->getToken();

// Create a new Facebook session using our token.
$session = new FacebookSession( $session->getToken() );
echo 'Connected to Facebook!';
} else {
// Show login url
echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends' ) ) . '">Login</a>';
}