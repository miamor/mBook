<?php
$type = $config->get('type');

if ($type == 'fb') {
	$helper = $config->FB->getRedirectLoginHelper();

//	$permissions = ['email','publish_actions','user_friends','user_posts','manage_pages','publish_pages','user_events']; // Optional permissions
	$permissions = ['email','publish_actions','user_friends','user_events','manage_pages','user_managed_groups']; // Optional permissions
	$loginUrl = $helper->getLoginUrl(MAIN_URL.'/fb-callback.php', $permissions);

	header('location: '.$loginUrl);

} else {
	$uname = $login->username = htmlentities($_POST['username'], ENT_QUOTES);
	$pass = $login->password = $_POST['password'];
	$token = $_POST['token'];
	$id = $_POST['id'];
	$type = $_POST['type'];
	$name = $_POST['name'];
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$avatar = urldecode($_POST['avatar']);
	$friends = json_decode($_POST['friends'], true);

	$ok = false;

	if ($uname && $pass) $member = $login->login();
	else echo '[type]error[/type][content]Missing paramemters![/content]';

	if ($login->uid) $ok = true;
	else echo '[type]error[/type][content]Username or password mismatched![/content]';

	if ($ok == true) {
		$config->u = $_SESSION['user_id'] = $login->uid;
		echo '[type]success[/type][content]Logged in successfully. Redirecting...[/content]';
	}
}
