<?php
$search->keyword = (isset($_POST['key'])) ? $_POST['key'] : ($config->get('key')) ? urldecode($config->get('key')) : null;
$search->keyword = urldecode($search->keyword);

if ($search->keyword) {
	$data = $search->search(); 
//	$search->response = $data = $search->searchGoogle();
}
if ($do) echo json_encode($data);
