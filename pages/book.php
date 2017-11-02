<?php
//$id = isset($n) ? $n : ''; // just use $n

include_once 'objects/book.write.php';
include_once 'objects/book.php';
include_once 'objects/chapter.php';

// prepare product object
$book = new Book();
$chapter = new Chapter();

$vPage = (isset($__pageAr[2])) ? $__pageAr[2] : null;
$m = (isset($__pageAr[3])) ? $__pageAr[3] : null;

if ($n) {
	// get book data
	$book->id = $n;
	$bView = $book->readOne();
	extract($bView);

	if ($book->id) {
		$page_title = $title;

		if (!$vPage || ($vPage == 'chapters' && !$m)) {
			// get chapters
			$chapter->bid = $book->id;
			$chapter->bookLink = $book->link;
			$chapter->readAll();
			$bChapters = $chapter->bChapters;
			$booksBuyList = $book->getSellStores();
		}

		if ($vPage == 'chapters') {
			if ($m) {
				// get chapter data
				$chapter->bid = $book->id;
				$chapter->bookLink = $book->link;
				$chapter->id = $m;
				if ($temp == 'feed') $chapter->isFeed = true;
				$byID = ($config->get('byID')) ? true : false;
				$bChap = $chapter->readOne($byID);

				$page_title = $bChap['title'];
			} else $page_title = $title.' danh sách chương';
		} else if ($vPage == 'reviews') {
			$page_title = $title.'\'s reviews';
		}
	}

} else {
	$page_title = "Books";
	/* Load in system/filter.php
	$stmt = $book->readAll();
	$_List = $book->all_list;
	*/
}


if ($do) include 'pages/system/write/'.$do.'.php';
else if ($mode) {
//	if ($uid === $config->u || $config->me['is_mod'] === 1)
	if (is_file('pages/views/book/'.$mode.'.php')) include 'pages/views/book/'.$mode.'.php';
	else include 'error.php';
} else if ($n) {
	if ($book->id) {
		include 'views/'.$page.'/view.php';
	} else if ($config->get('justadd')) {
		$pageTitle = 'Post chưa được confirm';
		include 'views/_temp/header.php';
		echo '<div class="alerts alert-warning">Bài post bạn vừa gửi đang được đưa vào hàng chờ. Từ giờ đến khi bài đăng được duyệt sẽ không được public. <br/>Bạn sẽ nhận được thông báo khi bài đăng này được duyệt.</div>';
	} else {
		include 'views/error.php';
	}
} else {
	include 'views/'.$page.'/list.php';
}
