<?php
require 'facebook.php';  // Include facebook SDK file
require 'functions.php';  // Include functions

if($session) {

  try {

    $user_profile = (new FacebookRequest(
      $session, 'GET', '/me'
    ))->execute()->getGraphObject(GraphUser::className());

    echo "Name: " . $user_profile->getName();

  } catch(FacebookRequestException $e) {

    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();

  }   

}


if ($user_profile) {
  try {
    
        $fbid = $user_profile['id'];                 // To Get Facebook ID
      $fbuname = $user_profile['username'];  // To Get Facebook Username
      $fbfullname = $user_profile['name']; // To Get Facebook full name
      $femail = $user_profile['email'];    // To Get Facebook email ID
      
  /* ---- Session Variables -----*/
  
      $_SESSION['FBID'] = $fbid;           
      $_SESSION['USERNAME'] = $fbuname;
            $_SESSION['FULLNAME'] = $fbfullname;
      $_SESSION['EMAIL'] =  $femail;
    //       checkuser($fbid,$fbuname,$fbfullname,$femail);    // To update local DB
  } catch (FacebookApiException $e) {
    error_log($e);
   $user_profile = null;
  }
}
if ($user_profile) {
  header("Location: findex.html");
} else {

 header("Location: findex.html");
}

?>
