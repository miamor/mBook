<?php
include_once 'objects/print.php';

// prepare product object
$print = new Prints();

if ($n) {
	// get book data
	$print->barcode = $n;
	
	// check if 13 digits
	if (preg_match("/^[0-9]{13}$/", $print->barcode)) {
		$_View = $print->readOne();
		extract($_View);
		$page_title = $title;
	}
} else {
	$page_title = "Tìm kiếm thông tin bản in";
}

if ($do) include 'system/'.$page.'/'.$do.'.php';
else if ($mode) include 'views/'.$page.'/'.$mode.'.php';
else if ($n) {
	include 'views/'.$page.'/view.php';
} else include 'views/'.$page.'/index.php';

/*
if ($do) include 'system/'.$page.'/'.$do.'.php';
else if ($mode) include 'views/'.$page.'/'.$mode.'.php';
else if ($n) {
	if ($print->id) {
		include 'views/'.$page.'/view.php';
	} else {
		include 'views/error.php';
	}
} else include 'views/'.$page.'/list.php';
*/