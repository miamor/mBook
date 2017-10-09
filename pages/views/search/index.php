<?php
$page_title = "Tìm kiếm";

if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

$config->addJS('plugins', 'JOB/JOB.js');
$config->addJS('dist', $page.'/index.js');

if ($do) include 'pages/system/'.$page.'/'.$do.'.php';
else include 'pages/views/_temp/'.$page.'/index.php';
