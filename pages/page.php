<?php
include_once 'objects/page.php';

// prepare product object
$page = new Page();

if ($n) {
	$page->id = $n;
	$eView = $page->readOne();
	extract($eView);

	if ($page->id) {
		$page_title = 'Book box #'.$page->id.': '.$page->title;
	}
} else {
	$page_title = 'Book box';
	$_List = $page->readAll();
}

if ($do) {
	include 'pages/system/'.$page.'/'.$do.'.php';
}
else if ($n) {
	if ($page->id) {
		include 'views/'.$page.'/view.php';
	}
	else include 'views/error.php';
}
else if ($mode) {
	if ($config->u && $config->me['is_mod'] === 1)
		include 'views/'.$page.'/'.$mode.'.php';
	else include 'error.php';
}
else include 'views/'.$page.'/list.php';
