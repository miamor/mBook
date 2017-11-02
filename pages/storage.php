<?php
//$id = isset($n) ? $n : ''; // just use $n

//include_once 'objects/storage.php';

// prepare product object
//$storage = new Storage();

include_once 'objects/book.write.php';
include_once 'objects/book.php';
// prepare product object
$book = new Book();

$page_title = "Kho sách lưu trữ";

$stmt = $book->readAll('','','','','','','',1,1,true);
$_List = $book->all_list;

if ($do) include 'system/'.$page.'/'.$do.'.php';
else if ($mode) include 'views/'.$page.'/'.$mode.'.php';
else include 'views/'.$page.'/list.php';
