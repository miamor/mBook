<?php
if ($mode && $box->stt == 0 && (!$config->u || $config->me['is_mod'] !== 1)) include 'pages/views/error.php';
else {
if ($mode == 'buy') {
	$page_title = 'Mua sách '.$box->book_title.' từ book box #'.$box->id;
}
else if ($mode == 'edit') {
	$page_title = 'Edit book box #'.$box->id.': '.$box->title;
} 
else if ($mode == 'addbook') {
	$page_title = 'Thêm đầu sách cho book box #'.$box->id.': '.$box->title;
} 
else if ($mode == 'editbooks') {
	if ($box->book_title) $page_title = 'Sửa đầu sách "'.$box->book_title.'" cho book box #'.$box->id.': '.$box->title;
	else $page_title = 'Sửa đầu sách cho book box #'.$box->id.': '.$box->title;
}

if (!$do && !$v && !$temp) {
	include 'pages/views/_temp/header.php';
	echo '<div class="col-lg-3 no-padding-left">';
	include 'pages/views/_temp/'.$page.'/v.sidebar.php';
	echo '</div>';
	echo '<div class="col-lg-9 no-padding">';
}

$config->addJS('dist', 'box/view.js');
if ($b) {
	if ($mode == 'editbooks') {
		$config->addJS('plugins', 'JOB/JOB.js');
		$config->addJS('dist', 'box/editbooks.one.js');
	}
	else if ($mode == 'buy') {
		if ($config->u && $config->me['coins'] >= $box->book_price) 
			$config->addJS('dist', 'box/buy.one.js');
	}
	else {
		$config->addJS('dist', 'box/view.book.one.js');
	}
}
else if ($mode == 'addbook') {
	$box->book_title = $box->book_coverIMG = null;
	$config->addJS('plugins', 'JOB/JOB.js');
	$config->addJS('dist', 'box/addbook.js');
}
else if ($mode == 'edit') {
	$config->addJS('dist', 'box/edit.js');
	$config->addJS(-1, 'https://maps.googleapis.com/maps/api/js?key=AIzaSyACkc-PYhlnPUWJaV2GlcCiEcuJujZsMdc&libraries=places&callback=initMap');
}
if (!$mode) {
	$config->addJS(-1, 'https://maps.googleapis.com/maps/api/js?key=AIzaSyACkc-PYhlnPUWJaV2GlcCiEcuJujZsMdc&libraries=places&callback=initMap');
}

if (($mode == 'editbooks' && $box->book_title) || $mode == 'addbook') {
	include 'objects/book.write.php';
	include 'objects/book.php';
	$book = new Book();
	$book->readAll('', '', '', '', '', 0);
	$allBooks = $book->all_list;
}

$allowModes = array('editbooks', 'buy', 'borrow', 'getBookData');
$allowModesU = array('buy', 'borrow');
$allowModesMod = array('editbooks');
if ($box->book_title) {
	if (in_array($mode, $allowModes)) {
		if ($mode == 'buy') {
			if (!$config->u) echo '<div class="alerts alert-error">Bạn cần đăng nhập để thực hiện giao dịch này.</div>';
			else if ($config->me['coins'] < $box->book_price) echo '<div class="alerts alert-error">Tài khoản của bạn không đủ để thực hiện giao dịch này.</div>';
			else include 'pages/views/_temp/'.$page.'/'.$mode.'.one.php';
		}
		else if ($mode == 'borrow') {
			if (!$config->u) echo '<div class="alerts alert-error">Bạn cần đăng nhập để thực hiện giao dịch này.</div>';
			else if ($config->me['coins'] < $box->book_price_rent) echo '<div class="alerts alert-error">Tài khoản của bạn không đủ để thực hiện giao dịch này.</div>';
			else include 'pages/views/_temp/'.$page.'/'.$mode.'.one.php';
		}
		else if ($mode == 'editbooks') {
			if (!$config->u) echo '<div class="alerts alert-error">Bạn cần đăng nhập để thực hiện thao tác này.</div>';
			else if (!$config->me['is_mod']) echo '<div class="alerts alert-error">Bạn không có quyền thực hiện thao tác này.</div>';
			else include 'pages/views/_temp/'.$page.'/'.$mode.'.one.php';
		}
		else {
			include 'pages/views/_temp/'.$page.'/'.$mode.'.one.php';
		}
	} else include 'pages/views/_temp/'.$page.'/v.book.one.php';
}
else if ($mode) include 'pages/views/_temp/'.$page.'/'.$mode.'.php';
else {
	if ($box->stt == 0) {
		echo '<div class="alerts alert-warning">Box này hiện đang bị khóa. Bạn không thể thực hiện request nào với box này nữa.</div>';
	}
	include 'pages/views/_temp/'.$page.'/view.php';
} 

if (!$do && !$v && !$temp) echo '</div><div class="clearfix"></div>';
}
