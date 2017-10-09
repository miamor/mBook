<?php
//$id = isset($n) ? $n : ''; // just use $n

include_once 'objects/gift.php';

// prepare product object
$gift = new Gift();

$m = (isset($__pageAr[2])) ? $__pageAr[2] : null;

if ($n) include 'views/'.$page.'/view.php';
else include 'views/'.$page.'/list.php';