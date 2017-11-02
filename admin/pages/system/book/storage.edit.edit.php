<?php
$uid = isset($_POST['uid']) ? $_POST['uid'] : null;
$bid = isset($_POST['bid']) ? $_POST['bid'] : null;
$num = isset($_POST['num']) ? $_POST['num'] : 0;

if ($uid && $bid) {
	$update = $book->updateDonation($_id, $uid, $bid, $num);
	if ($update) {
		echo '[type]success[/type][content]Donation updated successfully.[/content]';
	} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
} else echo '[type]error[/type][content]Missing parameters![/content]';
