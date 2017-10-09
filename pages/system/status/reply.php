<?php
$post->rContent = $content = isset($_POST['content']) ? $_POST['content'] : null;
$config->getTimestamp();
if ($content) {
	$theRv = $post->sReadCmtOne();
	if ($theRv['id']) echo '[type]error[/type][content]Spam detected![/content]';
	else {
		$post->rContent = $content;

		$reply = $post->reply();
		if ($reply) {
			echo '[type]success[/type][time]'.$config->timestamp.'[/time][dataID]'.$content.'[/dataID][content]Success![/content]';
		} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
	}
} else echo '[type]error[/type][content]Missing parameters[/content]';
