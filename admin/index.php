<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

// config file
include_once '../include/config.php';
$config = new Config();

if ($config->u) {
	$config->me = $config->getUserInfo();
}

if (check($__page, '?') > 0) $__page = $__page.'&';
else $__page = $__page;


$__pageAr = array_values(array_filter(explode('/', explode('?', rtrim($__page))[0])));
unset($__pageAr[0]);
$__pageAr = array_values(array_filter($__pageAr));

if ($__pageAr) {
	$page = $__pageAr[0];
	$n = (array_key_exists(1, $__pageAr) && $__pageAr[1]) ? $__pageAr[1] : null;
	$requestAr = explode('?', $__page);
	$config->request = isset($requestAr[1]) ? $requestAr[1] : null;
} else $config->request = explode('?', $__page)[1];

$v = $config->get('v');
$temp = $config->get('temp');
$type = $config->get('type');
$do = $config->get('do');


if ($do) header('Content-Type: text/plain; charset=utf-8');
else header('Content-Type: text/html; charset=utf-8');

if (!isset($page) || !$page) $page = 'feed';

if (!file_exists('pages/'.$page.'.php')) $page = 'error';

$page_title = 'mBook admin panel';

if ($page) {
//	if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';
	include 'pages/'.$page.'.php';
	if (!$do && !$v && !$temp) include 'pages/views/_temp/footer.php';
}
