<?php
include_once '../objects/review.php';

// prepare product object
$review = new Review();

if ($n) {
	// get review data
	$review->id = $n;
	if ($temp == 'feed') $review->isFeed = true;
	$rView = $review->readOne();
	extract($rView);

	if ($review->id) {
		$page_title = $author['name'].' review sách '.$book['title'];

	}
}

if ($type == 'facebook' && $_id) {
	$review->crawlFromFb($_id);
	//print_r($review->fb_post);
}

if ($type) {
	if (!$mode && $type == 'facebook') $mode = 'crawl';
	if ($do) include 'pages/system/'.$page.'/'.$type.'.'.$mode.'.'.$do.'.php';
	else {
		include 'views/'.$page.'/'.$type.'.'.$mode.'.php';
	}
}
else {
	if ($do) include 'pages/system/'.$page.'/'.$do.'.php';
	else if ($mode) {
		include 'views/'.$page.'/'.$mode.'.php';
	}
	else if ($n) {
		if ($review->id) {
			$mode = 'edit';
			include 'views/'.$page.'/'.$mode.'.php';
		} else include 'views/error.php';
	} else include 'views/'.$page.'/list.php';
}
