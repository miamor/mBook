<?php
if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

	$config->addJS('dist', 'box/list.js');
	$config->addJS(-1, 'https://maps.googleapis.com/maps/api/js?key=AIzaSyACkc-PYhlnPUWJaV2GlcCiEcuJujZsMdc&libraries=places&callback=initMap');

echo '<script>var placesID = ["'.implode('","', $box->placesID).'"];
var boxesName = ["'.implode('","', $box->boxesName).'"]</script>';
include 'pages/views/_temp/'.$page.'/list.php';
