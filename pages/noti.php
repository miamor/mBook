<?php
include_once 'objects/notification.php';
$noti = new Notification();

$id = isset($n) ? $n : '';
$m = (isset($__pageAr[2])) ? $__pageAr[2] : null;
if (isset($id) && $id) {
	$noti->id = $id;
	$nView = $noti->readOne();
	extract($nView);
	$id = $noti->id;
}

if ($do) include 'system/'.$page.'/'.$do.'.php';
