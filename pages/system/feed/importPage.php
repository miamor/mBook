<?php
include 'objects/page.php';
$page = new Page();

/*$page->name = (isset($_POST['name'])) ? $_POST['name'] : null;
$page->category = (isset($_POST['category'])) ? $_POST['category'] : null;
$page->fb_token = (isset($_POST['token'])) ? $_POST['token'] : null;
$page->fb_id = (isset($_POST['id'])) ? $_POST['id'] : null;
$page->avatar = (isset($_POST['avatar'])) ? $_POST['avatar'] : 0;
$page->cover = (isset($_POST['cover'])) ? $_POST['cover'] : 0;
*/
//$page->name = ($config->get('name') != null) ? htmlspecialchars(str_replace('+', ' ', $config->get('name'))) : null;
$page->name = ($config->get('name') != null) ? urldecode($config->get('name')) : null;
$page->category = ($config->get('category') != null) ? urldecode($config->get('category')) : null;
$page->fb_token = ($config->get('token') != null) ? urldecode($config->get('token')) : null;
$page->fb_id = ($config->get('id') != null) ? $config->get('id') : null;
$page->avatar = ($config->get('avatar') != null) ? urldecode($config->get('avatar')) : 0;
$page->cover = ($config->get('cover') != null) ? urldecode($config->get('cover')) : 0;

if ($page->name && $page->category && $page->fb_token && $page->fb_id) {
	$ins = $page->insert();
	if ($ins) echo 1;
	else echo 0;
} else echo -1;
