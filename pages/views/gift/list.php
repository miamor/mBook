<?php
$page_title = "Share to receive";
if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

if ($do) include 'pages/system/'.$page.'/'.$do.'.php';
else echo '<div class="alerts alert-info">Trang này không cho phép hiển thị danh sách.</div>';
/*
$stmt = $gift->readAll();
$gList = $gift->gList;

include 'pages/views/_temp/'.$page.'/list.php';
