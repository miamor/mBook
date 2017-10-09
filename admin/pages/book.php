<?php
//$id = isset($n) ? $n : ''; // just use $n

include_once 'objects/book.php';
include_once 'objects/chapter.php';

// prepare product object
$book = new Book_Admin();
$chapter = new Chapter_Admin();

$vPage = (isset($__pageAr[2])) ? $__pageAr[2] : null;
$m = (isset($__pageAr[3])) ? $__pageAr[3] : null;

if ($n == 'new') include 'views/'.$page.'/new.php';
else if ($n) include 'views/'.$page.'/view.php';
else include 'views/'.$page.'/list.php';
