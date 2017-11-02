<?php
if ($book->id) {
	$page_title = 'Sửa '.$title;

	include 'objects/genre.php';
	$genre = new Genre();
	$genre->readAll();
	$genList = $genre->all_list;

	include 'objects/author.php';
	$au = new Author();
	$au->readAll();
	$auList = $au->all_list;

	if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

	include 'pages/views/_temp/book/mode.'.$mode.'.php';

} else {
	include 'pages/views/error.php';
}
