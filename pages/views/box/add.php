<?php

$page_title = 'Thêm #bookstop';

if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

$config->addJS('dist', 'box/add.js');
$config->addJS(-1, 'https://maps.googleapis.com/maps/api/js?key=AIzaSyACkc-PYhlnPUWJaV2GlcCiEcuJujZsMdc&libraries=places&callback=initMap');

echo '<div class="col-lg-1"></div>
<div class="col-lg-10 no-padding">';
include 'pages/views/_temp/'.$page.'/'.$mode.'.php';
echo '</div>
<div class="col-lg-1"></div>
<div class="clearfix"></div>';

if (!$do && !$v && !$temp) echo '</div><div class="clearfix"></div>';
