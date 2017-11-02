<?php
// set page headers
$page_title = "Coins transfering";
if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

$uList = $user->readAll();

// display the products if there are any
include_once 'pages/views/_temp/'.$page.'/'.$type.'.'.$mode.'.php';

//include_once "pages/views/_temp/footer.php";
?>
