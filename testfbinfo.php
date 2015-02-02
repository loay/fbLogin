<?php
session_start();




use Facebook\FacebookRequest;

/**
 * Retrieve User’s Profile Information
 */
// Graph API to request user data
$request = ( new FacebookRequest( $session, 'GET', '/me' ) )->execute();

// Get response as an array
$user = $request->getGraphObject()->asArray();

print_r( $user );

?>