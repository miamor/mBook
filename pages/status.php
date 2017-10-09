<?php
include_once 'objects/post.php';
include_once 'objects/group.php';
// prepare product object
$post = new Post();
$group = new Group();

if ($n) {
	if ($temp == 'feed') $post->isFeed = true;
	// get review data
	$post->id = $n;
	if ($temp == 'feed') $post->isFeed = true; 
	$pView = $post->readOne();
	extract($pView);

	if ($post->id) {
		$page_title = $author['name'].'\'s status';
		if ($pView['gid']) {
			$group->id = $pView['gid'];
			$groupInfo = $group->readOne();
		} else {
			$group->id = null;
		}
	}
}

if ($do) include 'pages/system/'.$page.'/'.$do.'.php';
else if ($mode) include 'views/'.$page.'/'.$mode.'.php';
else if ($n) {
	if ($post->id) {
		if ($temp == 'feed') include 'pages/views/_temp/'.$page.'/view.feed.php';
		else {
			include 'views/'.$page.'/view.php';
		}
	} else include 'views/error.php';
} else include 'views/error.php';
