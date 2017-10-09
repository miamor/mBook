<?php
include_once 'objects/box.php';

// prepare product object
$box = new Box();
$b = $config->get('b');

if ($n) {
	$box->id = $n;
	$boxView = $box->readOne();
	extract($boxView);

	if ($box->id) {
		$page_title = 'Book box #'.$box->id.': '.$box->title;
		if ($b) {
			$box->book_id = $b;
			$box->readOneBook();
			if ($box->book_id) {
//				if (!$mode && !$do) {
				if ($mode == 'getBookData') {
				include_once 'objects/search.php';
				// prepare product object
				$search = new Search();
				$search->keyword = $box->book_title;
				$search->keyword = urldecode($box->book_title);
				$box->book_response = $search->search(); 
				}
				$page_title .= ' - '.$box->book_title;
			}
		}
	}
} else {
	$page_title = 'Book box';
	$boxesList = $box->readAll();
}

if ($do) {
	if ($b) {
		$box->book_id = $b;
		$box->readOneBook();
	}
	include 'pages/system/'.$page.'/'.$do.'.php';
}
else if ($n) {
	if ($box->id) {
		include 'views/'.$page.'/view.php';
	}
	else include 'views/error.php';
}
else if ($mode) {
	if ($mode != 'add' || ($mode == 'add' && $config->u && $config->me['is_mod'] === 1) )
		include 'views/'.$page.'/'.$mode.'.php';
	else include 'error.php';
}
else include 'views/'.$page.'/list.php';
