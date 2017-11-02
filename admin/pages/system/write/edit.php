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
		$book->thumb = $thumb = isset($_POST['cover']) ? $_POST['cover'] : null;
		$book->download = $download = isset($_POST['download']) ? $_POST['download'] : null;
		$book->status = $status = isset($_POST['status']) ? $_POST['status'] : 0;
		$book->published = $published = isset($_POST['published']) ? $_POST['published'] : 0;

		if ($book->type == 1) $book->author = $config->u;
		else {
			if (isset($_POST['author']) && $_POST['author'] != 0) {
				$author = $_POST['author'];
			} else {
				$author = (isset($_POST['author_text'])) ? ($_POST['author_text']) : null;
			}
			$book->author = $author;
		}

		$_genres = array();
		if (isset($_POST['genres'])) {
			foreach ($_POST['genres'] as $oL) {
				$_genres[] = '['.$oL.']';
			}
		}
		$book->genres = implode(',', $_genres);

		if ($des && $_genres) {
			$update = $book->update();
			if ($update) {
				$book->link = $book->link;
				if ($book->type == 1) $tt = 'Topic';
				else $tt = 'Book';
				echo '[type]success[/type][dataID]'.$book->link.'[/dataID][content]'.$tt.' updated successfully. Redirecting to <a href="'.$book->link.'">'.$title.'</a>...[/content]';
			} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
		} else echo '[type]error[/type][content]Missing parameters![/content]';
	}
} else echo '[type]error[/type][content]Missing parameters[/content]';
