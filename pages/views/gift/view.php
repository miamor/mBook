<?php

// get book data
$gift->id = $n;
$gView = $gift->readOne();
extract($gView);

if (!$gift->id) {
	
} else {

	$page_title = $author['name'].'\'s gift';

	if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

	if ($do) include 'pages/system/'.$page.'/'.$do.'.php';
	else {
		if ($temp == 'feed') include 'pages/views/_temp/'.$page.'/view.feed.php';
		else include 'pages/views/_temp/'.$page.'/view.php';
	}
}
