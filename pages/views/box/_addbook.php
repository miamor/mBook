<?php

if ($mode == 'addbook') {
	$page_title = 'Thêm đầu sách';
}

if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

if ($mode == 'addbook') {
	$box->book_title = $box->book_coverIMG = null;
	$config->addJS('plugins', 'JOB/JOB.js');
	$config->addJS('dist', 'box/addbook.js');
}

	include 'objects/book.write.php';
	include 'objects/book.php';
	$book = new Book();
	$book->readAll('', '', '', '', '', 0);
	$allBooks = $book->all_list;

echo '<div class="col-lg-2"></div>
<div class="col-lg-8 no-padding">';
include 'pages/views/_temp/'.$page.'/'.$mode.'.php';
echo '</div>
<div class="col-lg-2"></div>
<div class="clearfix"></div>';

if (!$do && !$v && !$temp) echo '</div><div class="clearfix"></div>';
