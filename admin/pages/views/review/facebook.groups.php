<?php
$page_title = "Crawl post";

if (!$do && !$v && !$temp) include 'pages/views/_temp/header.php';

/* PHP SDK v5.0.0 */
/* make the API call */
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $config->FB->get(
    '/'.$config->me['oauth_uid'].'/groups',
    $_SESSION['fb_access_token']
  );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$pagesEdge = $response->getGraphEdge();

// Only grab 5 pages
$pageCount = 0;
$groups = array();

do {
	foreach ($pagesEdge as $oneEdge) {
		$oneF = $oneEdge->asArray();
        $groups[] = $oneF;
	}
} while ($pagesEdge = $config->FB->next($pagesEdge));
//echo json_encode($friends);

//print_r($groups);

include 'pages/views/_temp/'.$page.'/'.$type.'.'.$mode.'.php';
