<?php 
$box->box_id = (isset($_POST['box_id'])) ? $_POST['box_id'] : 0;
$box->book_cover = (isset($_FILES['cover'])) ? $_FILES['cover'] : null;

if ($box->book_cover && $box->box_id) {
	$box->book_coverIMG =  $box->upload($box->book_cover);
	if ($box->book_coverIMG) {
		$returnBook = $box->returnBook();
		if ($returnBook) {
			header('Content-Type: text/html; charset=utf-8');
		//	echo '<script>window.location.href = "'.$box->link.'"</script>';
		} else echo 'Error';
	} else echo 'Error uploading file';
} else echo 'Missing paramemters';
