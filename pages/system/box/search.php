<?php
$box->keyword = (isset($_POST['key'])) ? $_POST['key'] : ($config->get('key')) ? urldecode($config->get('key')) : null;
$box->keyword = encodeURL($box->keyword);

if ($box->keyword) {
	$data = $box->search(); 
}
if ($do) echo json_encode($data);
