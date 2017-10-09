<?php
include 'objects/page.php';
$page = new Page();

// get user managing one_pages
try {
	$response = $config->FB->get('/me/accounts', $config->me['oauth_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}
$one_pagesEdge = $response->getGraphEdge();

// Only grab 5 one_pages
$one_pageCount = 0;
$friends = array();

do {
	foreach ($one_pagesEdge as $pk => $one_page) {
		$oneone_page = $one_page->asArray();
		if (in_array('ADMINISTER', $oneone_page['perms'])) {
			// get avatar, cover
			try {
				$response_avt = $config->FB->get('/'.$oneone_page['id'].'?fields=picture.width(130).height(130),cover', $config->me['oauth_token']);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
			$pIn_Edge = $response_avt->getGraphNode();
			$ar = array();
			foreach ($pIn_Edge as $av_cv) {
				if (is_object($av_cv)) {
					$ar[] = $av_cv->asArray();
				}
			}

			$one_pageData = array(
					'id' => $oneone_page['id'],
					'name' => $oneone_page['name'],
					'category' => $oneone_page['category'],
					'access_token' => $oneone_page['access_token'],
					'avatar' => (isset($ar[0])) ? $ar[0]['url'] : '',
					'cover' => (isset($ar[1])) ? $ar[1]['source'] : '',
					'imported' => $page->checkImport($oneone_page['id'])
				);
			$one_pages[] = $one_pageData;
			if ($pk%2 == 0) $cls = 'no-padding-left';
			else $cls = 'no-padding-right';
			
		echo '<div class="fb-one-page col-lg-6 '.$cls.'"><div class="box no-padding"><div class="box-body">
			<div class="fb-one-page-cover" style="background-image:url('.$one_pageData['cover'].')"></div>
			<img class="left fb-one-page-thumb" src="'.$one_pageData['avatar'].'"/>
			<div class="fb-one-page-info">
				<h4 class="fb-one-page-title">'.$one_pageData['name'].'</h4>
				<div class="fb-one-page-id">'.$one_pageData['id'].'</div>
				<div class="fb-one-page-cat">'.$one_pageData['category'].'</div>
				<div class="fb-one-page-btns">';
			if (!$one_pageData['imported']) echo '<div class="btn btn-success import-page btn-sm">Import</div>';
			else echo '<div class="btn btn-success import-page btn-sm disabled">Imported</div>';
		echo '</div>
			</div>
			<form method="POST" class="page-info hidden">
				<input name="name" type="text" value="'.$one_pageData['name'].'"/>
				<input name="id" type="text" value="'.$one_pageData['id'].'"/>
				<input name="cover" type="text" value="'.$one_pageData['cover'].'"/>
				<input name="avatar" type="text" value="'.$one_pageData['avatar'].'"/>
				<input name="category" type="text" value="'.$one_pageData['category'].'"/>
				<input name="token" type="text" value="'.$one_pageData['access_token'].'"/>
				<input type="submit" value="Submit"/>
			</form>
			<div class="clearfix"></div>
		</div></div></div>';
		}
	}
} while ($one_pagesEdge = $config->FB->next($one_pagesEdge));

//print_r($one_pages);

// me/accounts
// 1393393880717160?fields=picture.width(800).height(800)
// 1393393880717160?fields=cover
