<?php
//$id = isset($n) ? $n : ''; // just use $n

include_once 'objects/post.php';
include_once 'objects/feed.php';

// prepare product object
$feed = new Feed();
$post = new Post();

$page_title = "Feed";

$hashtagList = $feed->getHashtagList();

if ($do) include 'pages/system/'.$page.'/'.$do.'.php';
else {
/*	$feed->readAll();
	$_List = $feed->all_list;
*/	include 'views/'.$page.'/list.php';
}
