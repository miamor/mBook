<?php
$id = isset($n) ? $n : '';

if ($id) include 'views/'.$page.'/view.php';
else include 'views/'.$page.'/list.php';