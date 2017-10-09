<?php
$handling = $box->getRequestFromFile();
if ($handling == 0) { // finish
//	$box->finishBuy(); // everything is done inside arduinoBuy_finishGet() function
}
echo ($handling == $box->book_square_id) ? (-1) : $handling;

/*$isMyRequestDone = $box->checkMyRequestDone();
echo $isMyRequestDone;

/*
if ($box->checkMyTurn()) {
	$checkThisProgressStatus = $box->handleBuy();

	$finish = $box->finishBuy(); // finish my handle now
	echo ($finish) ? 1 : -1;
} else echo 0;
*/
//echo $checkThisProgressStatus['done'];
