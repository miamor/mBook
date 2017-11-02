<?php
header('Content-type: application/json; charset=utf-8');

include_once 'include/config.php';
$config = new Config();

include_once 'objects/login.php';
$login = new Login();

//$_SESSION['fb_access_token'] = null;

$helper = $config->FB->getRedirectLoginHelper();

try {
	$accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if (! isset($accessToken)) {
	if ($helper->getError()) {
		header('HTTP/1.0 401 Unauthorized');
		echo "Error: " . $helper->getError() . "\n";
		echo "Error Code: " . $helper->getErrorCode() . "\n";
		echo "Error Reason: " . $helper->getErrorReason() . "\n";
		echo "Error Description: " . $helper->getErrorDescription() . "\n";
	} else {
		header('HTTP/1.0 400 Bad Request');
		echo 'Bad request';
	}
	exit;
}

// Logged in
$_ar['status'] = 'success';
$_ar['token'] = $accessToken->getValue();

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $config->FB->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
/*echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);
*/
print_r($tokenMetadata);

$login->fb_uid = $tokenMetadata->getUserId();

if (!$login->getUserID()) {

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId(FB_APP_ID); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
	// Exchanges a short-lived access token for a long-lived one
	try {
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
	} catch (Facebook\Exceptions\FacebookSDKException $e) {
		$_ar['response']['error'] = "Error getting long-lived access token: " . $helper->getMessage();
		exit;
	}

	$_ar['token'] = $accessToken->getValue();
}

}
else {
	$accessToken = $login->getUserToken();
}


if ($accessToken) {
	$_SESSION['fb_access_token'] = (string) $accessToken;

	//redirect to retrieving data page

	// Retrieve user info
	try {
		// Returns a `Facebook\FacebookResponse` object
		$response = $config->FB->get('/me?fields=id,name,email', $accessToken);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		$_ar['response']['error'] = 'Graph returned an error: ' . $e->getMessage();
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		$_ar['response']['error'] = 'Facebook SDK returned an error: ' . $e->getMessage();
	}
	$user = $response->getGraphNode();

	$avatar = file_get_contents('https://graph.facebook.com/me?fields=picture.width(200).height(200)&access_token='.$accessToken);
	/* handle the result */
	$avatar = json_decode($avatar, true);
//	$avatar = $avatar['data']['url'];
	$avatar = $avatar['picture']['data']['url'];


	// login
	$login->fb_uid = $user['id'];
	$login->fb_token = $accessToken;
	$login->name = $name = $user['name'];
	$login->username = $uname = encodeURL($name, '.');

	//echo $accessToken.'~'.$_SESSION['fb_access_token'];

	$login->avatar = $avatar;
	if ($login->loginFb()) {
		$config->u = $_SESSION['user_id'] = $login->id;
		header('location: '.MAIN_URL);
	}
	else echo 'Error while logging in.';

	//include 'me.php';
}

//echo json_encode($_ar);
