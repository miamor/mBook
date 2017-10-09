<?php
$page_title = 'Tìm kiếm đầu sách trong các #bookStop';
if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

$config->addJS('dist', 'box/search.js');
$config->addJS(-1, 'https://maps.googleapis.com/maps/api/js?key=AIzaSyACkc-PYhlnPUWJaV2GlcCiEcuJujZsMdc&libraries=places&callback=initMap');

$box->keywordTitle = (isset($_POST['key'])) ? $_POST['key'] : ($config->get('key')) ? urldecode($config->get('key')) : null;
$box->keyword = encodeURL($box->keywordTitle);

if ($box->keyword) {
	$response = $box->search(); 
	echo '<script>var placesID = ["'.implode('","', $box->placesID).'"];
	var boxesName = ["'.implode('","', $box->boxesName).'"];
	var placesName = ["'.implode('","', $box->placesName).'"]</script>';
	include 'pages/views/_temp/'.$page.'/'.$mode.'.php';
} else echo '<div class="alerts alert-error">Không có từ khóa.</div>';

if ($temp == 'withjs') {
	echo '<script src="'.JS.'/box/search.js"></script><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACkc-PYhlnPUWJaV2GlcCiEcuJujZsMdc&libraries=places&callback=initMap"></script>';
}
