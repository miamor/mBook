<?php
if ($config->u && $config->me['coins'] > $box->book_price) {
$isMyTurn = $box->checkMyTurn();
$isNotDone = $box->checkInProgress();
if ($isNotDone) {
	if ($isMyTurn) {
		echo ($box->handleBuy()) ? 1 : -1;
	} else echo 0;
} else echo 2; // this request is done handling
}
