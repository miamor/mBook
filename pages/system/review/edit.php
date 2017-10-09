<?php
$review->content = $content = isset($_POST['content']) ? $_POST['content'] : null;
$review->iid = $iid = isset($_POST['bid']) ? $_POST['bid'] : null;
$review->rate = $rate = isset($_POST['rate']) ? $_POST['rate'] : 0;

if ($content && $rate && $iid) {
	$update = $review->update();
	if ($update) {
		echo '[type]success[/type][dataID]'.$review->link.'[/dataID][content]Review updated successfully. Redirecting...[/content]';
	} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
} else echo '[type]error[/type][content]Missing parameters![/content]';
