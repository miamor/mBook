<?php
$response = $search->response;

if (!$do && !$v && !$temp && !$p) {
	include 'pages/views/_temp/header.php';
	include 'pages/views/_temp/'.$page.'/index.php';
}
//			$config->addJS('plugins', 'DataTables/datatables.min.js');
//			$config->addJS('dist', 'ratings.min.js');
//			$config->addJS('dist', $page.'/view.js');
			include 'pages/views/_temp/'.$page.'/search.php';
