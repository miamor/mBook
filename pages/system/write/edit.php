<?php
$ok = true;

$title = isset($_POST['title']) ? $_POST['title'] : null;
if ($title) {
	if ($title != $book->title) {
		$book->title = $title;
		$theBook = $book->sReadOne();
		if ($theBook['id']) {
			echo '[type]error[/type][content]One topic with this title has already existed. Please choose another title if this is different from <a href="'.$theBook['link'].'">'.$title.'</a>[/content]';
			$ok = false;
		}
	} 
	
	if ($ok == true) {
		$book->title = $title;
		$book->des = $des = isset($_POST['des']) ? $_POST['des'] : null;
		$book->cover = $cover = isset($_POST['cover']) ? $_POST['cover'] : null;

		$_genres = array();
		if (isset($_POST['genres'])) {
			foreach ($_POST['genres'] as $oL) {
				$_genres[] = $oL;
			}
		}
		$book->genres = implode(',', $_genres);

		if ($des && $_genres) {
			$update = $book->update();
			if ($update) {
				$book->link = $config->bLink.'/'.$book->link;
				echo '[type]success[/type][dataID]'.$book->link.'[/dataID][content]Topic updated successfully. Redirecting to <a href="'.$book->link.'">'.$title.'</a>...[/content]';
			} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
		} else echo '[type]error[/type][content]Missing parameters![/content]';
	}
} else echo '[type]error[/type][content]Missing parameters[/content]';