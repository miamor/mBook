<?php
//$id = isset($n) ? $n : ''; // just use $n

include_once 'objects/storage.php';

// prepare product object
$storage = new Storage();

if ($n) {
	// get book data
	$storage->id = $n;
	$_View = $storage->readOne();
	extract($_View);

	if ($storage->id) {
		$page_title = $title;
	}
} else {
	$page_title = "Kho sách lưu trữ";

	$stmt = $storage->readAll();
	$_List = $storage->all_list;
}

if ($do) include 'system/'.$page.'/'.$do.'.php';
else if ($mode) include 'views/'.$page.'/'.$mode.'.php';
else if ($n) {
	if ($storage->id) {
		include 'views/'.$page.'/view.php';
	} else {
		include 'views/error.php';
	}
} else include 'views/'.$page.'/list.php';
