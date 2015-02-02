<?php


session_start();

$app_id = 'INSERT APP ID';
$app_secret = 'INSERT APP SECRET';
 


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
 
// init app with app id (APPID) and secret (SECRET)

FacebookSession::setDefaultApplication($app_id, $app_secret); 
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper("http://loay.yzi.me/webapp/fbtest/login.php");
// $loginUrl = $helper->getLoginUrl();

try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
	echo $ex;
} catch( \Exception $ex ) {
  // When validation fails or other local issues
	echo $ex;
}
 
// see if we have a session
if ($session)  {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
   
  // print data
  echo  print_r( $graphObject, 1 );
  

} else {
  // show login url
  echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
  echo "Please Login";
}

?>