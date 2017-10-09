<?php 
$box->title = (isset($_POST['title'])) ? $_POST['title'] : null;
$box->rows = (isset($_POST['rows'])) ? $_POST['rows'] : null;
$box->cols = (isset($_POST['cols'])) ? $_POST['cols'] : null;
$box->location = (isset($_POST['location'])) ? $_POST['location'] : null;
$box->thumb = (isset($_POST['thumb'])) ? $_POST['thumb'] : 0;
$box->place_id = (isset($_POST['place_id'])) ? $_POST['place_id'] : null;

if ($box->title && $box->rows && $box->cols && $box->location && $box->place_id) {
	$add = $box->add();
	if ($add) {
		echo '[type]success[/type][content]Box <a href="'.$config->boxLink.'/'.$box->id.'">'.$box->title.'</a> added successfully[/content]';
	} else echo '[type]error[/type][content]Error[/content]';
} else echo '[type]error[/type][content]Missing paramemters[/content]';
