<?php
$uid = isset($_POST['uid']) ? $_POST['uid'] : null;
$bid = isset($_POST['bid']) ? $_POST['bid'] : null;
$status = isset($_POST['stt']) ? $_POST['stt'] : 0;

if ($uid && $bid) {
	if ($status != $borrow['stt']) $sendNoti = true;
	else $sendNoti = false;
	$update = $book->updateBorrow($_id, $uid, $bid, $status, $sendNoti);
	if ($update) {
		echo '[type]success[/type][content]Borrow request updated successfully.[/content]';
	} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
} else echo '[type]error[/type][content]Missing parameters![/content]';
