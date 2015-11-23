<?php
	session_start();
       //session_destroy();
       //session_start();
        
	global $APP_HELPER;
	global $APP_TWITTER_SESSION;
	global $APP_TWITTER_ACCESS_TOKEN;
	global $APP_FBSESSION;
	global $APP_PROFILE;
	global $APP_LOGIN;
	global $APP_LOGOUT;
	global $APP_FBSESSION;
	global $db;

	require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');
	//require_once('curlClass.php');

	use Facebook\FacebookRequest;
	use Facebook\FacebookSession;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookRedirectLoginHelper;

	// db
	DEFINE('DB_HOST','localhost');
	DEFINE('DB_USER','terragon_closeup');
	DEFINE('DB_NAME','terragon_closeup');
	DEFINE('DB_PASS','closeup@1');
	DEFINE('DB_PORT','3306');

        
    // App Base URL
    DEFINE('BASE_URL','https://terragonmedia.com/closeup/');
        
	//facebook application configs go here
	DEFINE('FB-ACCESS-TOKEN','');
	DEFINE('FB_APP_ID','751195085006194');
	DEFINE('FB_APP_SECRET','75a99f51491976881835e47acb2715c2');
    DEFINE('LOGOUT_URL','');
        
	/*if(isset($_GET['app_data']) && !empty($_GET['app_data']))
		DEFINE('REDIRECT_URL','http://nominate.galaxys6edge.ng/mobile-landing.php?&app_data='.urlencode($_GET['app_data']));
	else
		DEFINE('REDIRECT_URL',BASE_URL.'register.php');
                //$sitebaseurl = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."/";
                //DEFINE('REDIRECT_URL',$sitebaseurl."apply.php");


	//FB SECTION...
	$APP_FBSESSION = FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);

	$APP_HELPER = new FacebookRedirectLoginHelper(REDIRECT_URL);

	if (isset( $_SESSION ) && isset( $_SESSION['fb_token'])) {
	  $APP_FBSESSION = new FacebookSession( $_SESSION['fb_token'] );
	  try {
	    if ( !$APP_FBSESSION->validate() ) {
	      $APP_FBSESSION = null;
	    }
	  } catch ( Exception $e ) {
	    $APP_FBSESSION = null;
	  }
	}


	if (!isset( $APP_FBSESSION ) || $APP_FBSESSION === null) {
	  try {
	    $APP_FBSESSION = $APP_HELPER->getSessionFromRedirect();
	  } catch( FacebookRequestException $ex ) {
	    print_r( $ex );
	  } catch( Exception $ex ) {
	    print_r( $ex );
	  }
	}

	if ( isset( $APP_FBSESSION ) ) {
	  $_SESSION['fb_token'] = $APP_FBSESSION->getToken();
	  $APP_FBSESSION = new FacebookSession($APP_FBSESSION->getToken() );

	  $request = new FacebookRequest($APP_FBSESSION, 'GET', '/me' );
	  $APP_PROFILE = $request->execute()->getGraphObject()->asArray();

	  $APP_LOGOUT = $APP_HELPER->getLogoutUrl( $APP_FBSESSION, LOGOUT_URL);
	} else {
	  $APP_LOGIN = $APP_HELPER->getLoginUrl(array( 'email', 'user_friends','public_profile' ));
	}*/
?>
