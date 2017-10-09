<?php

if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

	$config->addJS('plugins', 'DataTables/datatables.min.js');

	if ($vPage) {
		$config->addJS('dist', 'ratings.min.js');
		$config->addJS('dist', 'write/view.'.$vPage.'.js');
		if ($m) {
			// get [bLink]/test-the-display/chapters/chuong-2-ten-chuong-2?temp=feed
			if ($temp == 'feed') include 'pages/views/_temp/'.$page.'/view.'.$vPage.'.one.feed.php';
			else include 'pages/views/_temp/'.$page.'/view.'.$vPage.'.one.php';
		} else include 'pages/views/_temp/'.$page.'/view.'.$vPage.'.php';
	} else {
		$config->addJS('dist', 'write/view.js');
		include 'pages/views/_temp/'.$page.'/view.php';
	}
