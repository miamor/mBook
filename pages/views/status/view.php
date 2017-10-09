<?php
if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

$config->addJS('dist', 'status/view.js');
include 'pages/views/_temp/'.$page.'/view.php';
