<?php
include_once 'objects/author.php';

// prepare product object
$author = new Author();

if ($n) {
	// get book data
	$author->id = $n;
	$_View = $author->readOne();
	extract($_View);
	
	if ($author->id) {
		$page_title = $name;
		$works = $author->works();
	}
} else {
	$page_title = "Tác giả";

	$stmt = $author->readAll();
	$_List = $author->all_list;
}

if ($do) include 'system/'.$page.'/'.$do.'.php';
else if ($mode) include 'views/'.$page.'/'.$mode.'.php';
else if ($n) {
	if ($author->id) {
		include 'views/'.$page.'/view.php';
	} else {
		include 'views/error.php';
	}
} else include 'views/'.$page.'/list.php';