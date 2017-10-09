<?php

if ($mode == 'edit') {
	$page_title = 'Trả sách';
}

if (!$do && !$v && !$temp) {
	include 'pages/views/_temp/header.php';
}

//$config->addJS('dist', 'box/returnbook.js');

include 'pages/views/_temp/'.$page.'/'.$mode.'.php';

if (!$do && !$v && !$temp) echo '</div><div class="clearfix"></div>';
