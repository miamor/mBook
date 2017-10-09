<?php 
$box->title = (isset($_POST['title'])) ? $_POST['title'] : null;
$box->location = (isset($_POST['location'])) ? $_POST['location'] : null;
$box->thumb = (isset($_POST['thumb'])) ? $_POST['thumb'] : 0;
$box->place_id = (isset($_POST['place_id'])) ? $_POST['place_id'] : null;

if ($box->title && $box->location && $box->place_id) {
	$edit = $box->edit();
	if ($edit) {
//		echo '[type]success[/type][dataID]'.$box->link.'[/dataID][content]Box updated successfully! Redirecting... [/content]';
		echo '[type]success[/type][content]Box updated successfully! Redirecting... [/content]';
	} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
}
