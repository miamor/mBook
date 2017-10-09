<?php
if (!$box->book_id || $box->book_num <= 0) {
	// give error, no book found
	echo -2;
} else {
	if ($config->u && $config->me['coins'] > $box->book_price) {
		$buy = $box->requestBuy();
		echo ($buy) ? 1 : -1;
	} 
	else echo -3;
}
/*
$lastBuy = $box->lastBuy();

if (!$box->book_id || $box->book_num <= 0) {
	// give error, no book found
	echo -2;
}
else if ($lastBuy['done'] == 1 || ($lastBuy['done'] == 0 && $lastBuy['iid'] == $box->book_id) ) {
	$buy = $box->buy();
	if ($buy) 	echo 1;
	else echo -1;
}
else echo 0;
*/
