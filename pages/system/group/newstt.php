<?php
$post->content = $content = isset($_POST['content']) ? $_POST['content'] : null;
if ($content) {
	$theRv = $post->sReadOne();
	if ($theRv['id']) echo '[type]error[/type][content]One topic with this title has already existed. Please choose another title if this is different from <a href="'.$theRv['link'].'">'.$title.'</a>[/content]';
	else {
		$post->content = $content;
		$post->rate = $rate = isset($_POST['rate']) ? $_POST['rate'] : 0;
		$post->gid = $gid = $group->id;
		if ($content) {
			$create = $post->create();
			if ($create) {
				echo '[type]success[/type][dataID]'.$post->id.'[/dataID][content]Status added successfully.[/content]';
			} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
		} else echo '[type]error[/type][content]Missing parameters![/content]';
	}
} else echo '[type]error[/type][content]Missing parameters[/content]';
