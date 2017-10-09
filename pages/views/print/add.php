<?php
$page_title = 'Add book by cover';

if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

$config->addJS('plugins', 'JOB/JOB.js');
$config->addJS('dist', $page.'/add.js');

include 'pages/views/_temp/'.$page.'/'.$mode.'.php';
