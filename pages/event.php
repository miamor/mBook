<?php
include_once 'objects/event.php';

// prepare product object
$event = new Event();

if ($n) {
	$event->id = $n;
	$eView = $event->readOne();
	extract($eView);

	if ($event->id) {
		$page_title = 'Book box #'.$event->id.': '.$event->title;
	}
} else {
	$page_title = 'Book box';
	$_List = $event->readAll();
}

if ($do) {
	include 'pages/system/'.$page.'/'.$do.'.php';
}
else if ($n) {
	if ($event->id) {
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
