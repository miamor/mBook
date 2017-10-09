<?php
include_once 'objects/group.php';

// prepare product object
$group = new Group();

if ($n) {
	// get book data
	$group->id = $n;
	$_View = $group->readOne();
	extract($_View);
	
	if ($group->id) {
		include_once 'objects/post.php';
		$post = new Post();

		$page_title = $title;

		// get topics
		$post->gid = $group->id;
		$post->groupLink = $group->link;
		$post->readAll();
		$postList = $post->all_list;
	}
} else {
	$page_title = "Nhóm";

	$stmt = $group->readAll();
	$_List = $group->all_list;
}

if ($do) include 'system/'.$page.'/'.$do.'.php';
else if ($mode) include 'views/'.$page.'/'.$mode.'.php';
else if ($n) {
	if ($group->id) {
		include 'views/'.$page.'/view.php';
	} else {
		include 'views/error.php';
	}
} else include 'views/'.$page.'/list.php';