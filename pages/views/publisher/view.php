<?php
$page_title = "Publisher name";
if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

$m = (isset($__pageAr[2])) ? $__pageAr[2] : null;
$mID = (isset($__pageAr[3])) ? $__pageAr[3] : null;

if ($mID) $mainFile = 'pages/views/_temp/'.$page.'/v.'.$m.'.one.php';
else $mainFile = 'pages/views/_temp/'.$page.'/v.'.$m.'.php';

$sideBarFile = 'pages/views/_temp/'.$page.'/v.sidebar.php';

include 'pages/views/_temp/'.$page.'/view.php';