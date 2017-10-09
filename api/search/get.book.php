<?php
include_once 'objects/search.php';
$search = new Search();

// handle request
if ($config->get('key') != null) {
	$search->keyword = $config->get('key');
	$search->keyword = urldecode($search->keyword);

	if ($search->keyword) {
		$search->response = $data = $search->search();
	//	$search->response = $data = $search->searchGoogle();
	}

} else $data = array('error' => 1, 'content' => 'Empty input.');

// return
json_encode($data);