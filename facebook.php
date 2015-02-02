<?php

// include required files form Facebook SDK


session_start();
 
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

 

//FacebookSession::setDefaultApplication('415109641971917','9f7db1c02479062e5724e0a045e0d1de');
$app_id = 'INSERT APP ID';
$app_secret = 'INSERT APP SECRET';
 
FacebookSession::setDefaultApplication($app_id, $app_secret);
 
// login helper with redirect_uri
//$helper = new FacebookRedirectLoginHelper( 'http://loay.yzi.me/webapp/fbtest/index2.php' );
$helper = new FacebookRedirectLoginHelper("http://loay.yzi.me/webapp/fbtest/index2.php", $app_id, $app_secret);
$loginUrl = $helper->getLoginUrl();
//$helper = new FacebookRedirectLoginHelper();


try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
 
// see if we have a session
if ( isset( $session ) ) {
 $request = new FacebookRequest($session, 'GET', '/me');
$response = $request->execute();
$graphObject = $response->getGraphObject();
}






?>