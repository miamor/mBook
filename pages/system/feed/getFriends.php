<?php
// get user friends
try {
	$response = $config->FB->get('/me/friends', $config->me['oauth_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}
$pagesEdge = $response->getGraphEdge();

// Only grab 5 pages
$pageCount = 0;
$friends = array();

do {
	foreach ($pagesEdge as $page) {
		$oneF = $page->asArray();
		$uInfo = $config->sGetUserInfo_FB($oneF['id']);
		if (!in_array($config->u, $uInfo['followers'])) {
			$friends[] = $uInfo;
		}
	}
} while ($pagesEdge = $config->FB->next($pagesEdge));
echo json_encode($friends);

/*
if (count($pagesEdge) > 0) {
	echo '<div class="fb-friend-list">';
	echo '<h4>Bạn bè của bạn trên facebook. Theo dõi họ trên mBook để nhận thông báo về hoạt động của họ!</h4>';
do {
	foreach ($pagesEdge as $page) {
		$friends[] = $oneF = $page->asArray();
		$uInfo = $config->sGetUserInfo_FB($oneF['id']);
		echo '<div class="fb-one-friend left">
			<img class="left img-circle fb-one-friend-thumb" src="'.$uInfo['avatar'].'"/>
			<div class="fb-one-friend-info">
				<a href="'.$uInfo['link'].'">'.$uInfo['name'].'</a>
				<div class="fb-one-friend-btns">
					<a href="#" class="btn btn-success follow-fb-friend btn-sm" data-u="'.$uInfo['id'].'">Follow</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>';
	}
} while ($pagesEdge = $config->FB->next($pagesEdge));

echo '<div class="clearfix"></div>
	</div>';
}
*/
