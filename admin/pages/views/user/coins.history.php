<?php
// set page headers
$page_title = "Coins transfering history";
if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

//$config->addJS('plugins', 'DataTables/datatables.min.js');
$config->addJS('dist', 'write/list.js');

$uList = $user->readAll();

// display the products if there are any
include_once 'pages/views/_temp/'.$page.'/'.$type.'.'.$mode.'.php';

//include_once "pages/views/_temp/footer.php";
?>
