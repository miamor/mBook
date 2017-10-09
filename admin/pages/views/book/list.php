<?php
$page_title = "Books";
$stmt = $book->readAll();
$_List = $book->all_list;

if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

if ($do) include 'pages/system/'.$page.'/'.$do.'.php';
else {
	$config->addJS('plugins', 'DataTables/datatables.min.js');
	$config->addJS('dist', $page.'/list.js');
	include 'pages/views/_temp/'.$page.'/list.php';
}