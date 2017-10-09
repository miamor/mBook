<?php
if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

	$config->addJS('dist', '/ratings.min.js');
	$config->addJS('dist', $page.'/list.js');
	include 'pages/views/_temp/'.$page.'/list.php';
