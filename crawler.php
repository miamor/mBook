<?php
include_once 'include/config.php';
$config = new Config();
$ch = curl_init();

include_once 'include/crawler/crawler.php';
include_once 'include/crawler/downloadsach.php';
include_once 'include/crawler/taisachhay.php';
include_once 'include/crawler/sachvui.php';
include_once 'include/crawler/ddlqd.php';
include_once 'include/crawler/goodreads.php';

// prepare product object
$crawler = new Crawler();
$downloadsach = new Crawler_Downloadsach();
$taisachhay = new Crawler_Taisachhay();
$sachvui = new Crawler_Sachvui();
$ddlqd = new Crawler_DDLQD();

$goodreads = new Crawler_Goodreads();

/**/
//$authorData = $crawler->get_web_page("http://vi.wikipedia.org/w/api.php?action=query&prop=revisions&rvprop=content&rvsection=0&format=json&titles=George%20Orwell");

//var_dump($authorData);

//$downloadsach->crawl_books_pages('danh-nhan', "[10]", 1, 6);
//$sachvui->getBooks();
//$taisachhay->crawl_books_pages('sach-tam-ly', "[5]", 1, 1);


$temp = $_GET['temp'];

if ($temp == 'goodreads') {
	$goodreads->bID = 1;
	for ($i = 11; $i <= 20; $i++) {
		echo '<h2>#'.$i.'</h2>';
		$goodreads->crawl('https://www.goodreads.com/api/reviews_widget_iframe?format=html&isbn=8936024919436&num_reviews=150&page='.$i);
	}
}
else if ($temp == 'crawl') {
	echo 'Crawl authors~
	<script src="http://localhost/mBook/assets/jquery/jquery-2.2.3.min.js"></script>
	<script src="http://localhost/mBook/assets/dist/js/crawler.js"></script>';
	// find all authors
	$auList = $crawler->getAuthors();
	foreach ($auList as $auO) {
		// fetch data of this author
		$url = MAIN_URL.'/crawler.php?author='.urlencode($auO).'&temp=crawl';
		echo '<h2>'.$auO.'</h2>'.$url;
		echo '<div data-author="'.$auO.'" class="result"></div>';
		echo '<hr/>';
	}
} 
else if ($temp == 'addAuthor') {
	$author = $_POST['author'];
	if ($crawler->checkAuthor($author) <= 0) {
		echo $crawler->addAuthor($author, $_POST['content']);
	}
} 
else if ($temp == 'updateAuthors') {
	$crawler->updateAuthors();
}
else if ($temp == 'websosanh') {
	$crawler->websosanh();
}
else if ($temp == 'sore') {
	$crawler->sore();
}
else if ($temp == 'addNoti') {
	$valAr = array(
		'type' => 'welcome'
	);
	echo $config->addNoti($valAr);
	echo '<hr/>';
	$contentData = array('rate' => 2, 'content' => 'bad');
	$valAr = array(
		'type' 	=> 'rate-review',
		'tbl' 		=> 'books_reviews_ratings',
		'iid' 		=> 6,
		'from_uid' 	=> 3,
		'content' => json_encode($contentData)
	);
	echo $config->addNoti($valAr);
}

else if ($temp == 'fb_events') {
if ($config->me['oauth_uid'] == '1893927424152208') { // is Miamor East
	$accessToken = $config->me['oauth_token'];
	echo $accessToken;

	try {
		$response = $config->FB->get('/me/events', $accessToken);
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
	$maxPages = 5;
	$pageCount = 0;
	$events = array();

	do {
		echo '<h1>Page #' . $pageCount . ':</h1>' . "\n\n";

		foreach ($pagesEdge as $page) {
//			var_dump($page->asArray());
			$events[] = $evt = $page->asArray();
			$checkAdd = $crawler->addEvent($page->asArray());
//			echo $evt['name'].': '.$checkAdd.'<br/>';
		}
		$pageCount++;
	} while ($pageCount < $maxPages && $pagesEdge = $config->FB->next($pagesEdge));

//	print_r($events);
}
}
else if ($temp == 'fb_events_curl') {
	
//set url
//$url = $_GET['url'];
$url = 'https://m.facebook.com/search/events/?q=sách';
$url = 'https://m.facebook.com/login.php?next='.urlencode($url);
echo $url.'<hr/>';

//set POST variables
$fields = array(
	'charset_test' => '€,´,€,´,水,Д,Є',
	'email' => 'miamorwest@gmail.com',
	'pass' => 'westlife297',
	'login' => 'Login'
);
$result = cURL($url, $fields);
echo $result;



$_SESSION['k'] = 1;

}




function cURL ($url, $fields) {
	global $ch;

	//set the url
	curl_setopt($ch,CURLOPT_URL, $url);

	if ($fields) {
		$fields_string = '';
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		// set number of POST vars, POST data
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	}

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Charset: utf-8','Accept-Language: en-us,en;q=0.7,bn-bd;q=0.3','Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5')); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd ());
	curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd ());
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "user_agent");
	curl_setopt($ch, CURLOPT_REFERER, "http://m.facebook.com");

	//execute post
	$result = curl_exec($ch) or die(curl_error($ch));

	return $result;
}

