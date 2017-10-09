<?php
include_once 'objects/search.php';

// prepare product object
$search = new Search();

$p = $config->get('p');
$search->keyword = (isset($_POST['key'])) ? $_POST['key'] : ($config->get('key')) ? urldecode($config->get('key')) : null;
$search->keyword = urldecode($search->keyword);
if ($search->keyword) {
	$page_title = 'Tìm kiếm '.$search->keyword;
//	$data = $search->search(); 
}

if ($do) include 'pages/system/'.$page.'/'.$do.'.php';
else if ($search->keyword) {
	include 'pages/system/'.$page.'/search.php';
	include 'views/'.$page.'/search.php';
} else {
	include 'views/'.$page.'/index.php';
}
