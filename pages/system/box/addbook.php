<?php 
$box->book_bid = (isset($_POST['bid'])) ? $_POST['bid'] : 0;
$box->book_cover = (isset($_FILES['cover'])) ? $_FILES['cover'] : null;
$box->book_back = (isset($_FILES['back'])) ? $_FILES['back'] : null;
$box->book_barcode = (isset($_POST['barcode'])) ? $_POST['barcode'] : null;
$box->book_title = (isset($_POST['title'])) ? $_POST['title'] : null;
$box->book_price = (isset($_POST['price'])) ? $_POST['price'] : null;
$box->book_price_rent = (isset($_POST['price_rent'])) ? $_POST['price_rent'] : null;
$box->book_num = (isset($_POST['num'])) ? $_POST['num'] : null;
$box->book_square_id = (isset($_POST['square'])) ? $_POST['square'] : null;
//$box->book_edition = (isset($_POST['edition'])) ? $_POST['edition'] : 0;

if ($box->book_title && $box->book_cover && $box->book_back && $box->book_barcode && $box->book_square_id /*&& $box->book_price && $box->book_price_rent && $box->book_num*/) {
	$box->book_coverIMG = $box->upload($box->book_cover);
	$box->book_backIMG = $box->upload($box->book_back, false);
	if ($box->book_coverIMG && $box->book_backIMG) {
		$addBook = $box->addBook();
		if ($addBook) {
//			header('Content-Type: text/html; charset=utf-8');
//			echo '<script>window.location.href = "'.$box->link.'"</script>';
			echo '[type]success[/type][dataID]'.$box->link.'[/dataID][content]Đầu sách '.$box->book_title.' đã được thêm vào book box #'.$box->id.'. Đang chuyển trang...[/content]';
		} else echo '[type]error[/type][content]Có lỗi xảy ra trong quá trình thực thi. Vui lòng liên hệ administrators để biết thêm thông tin chi tiết.[/content]';
	} else echo '[type]error[/type][content]Có lỗi xảy ra trong quá trình upload hình ảnh. Vui lòng liên hệ administrators để biết thêm thông tin chi tiết.[/content]';
} else echo '[type]error[/type][content]Missing paramemters.[/content]';
