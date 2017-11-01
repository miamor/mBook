<?php
$reason = isset($_POST['reason']) ? $_POST['reason'] : null;
$from_uid = isset($_POST['from']) ? $_POST['from'] : null;
$to_uid = isset($_POST['to']) ? $_POST['to'] : null;
$coins = isset($_POST['coins']) ? $_POST['coins'] : 0;
if ($coins > 0) $type = 1;
else if ($coins < 0) $type = -1;

if ($to_uid && $type && $coins) {
	$create = $user->changeCoin($from_uid, $to_uid, $coins, $reason);
	if ($create) {
		echo '[type]success[/type][dataID]'.$config->uLink.'?type=coins&mode=change[/dataID][content][/content]';
	} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
} else echo '[type]error[/type][content]Missing parameters[/content]';
