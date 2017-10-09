<?php 
$print->cover = (isset($_FILES['cover'])) ? $_FILES['cover'] : null;
$print->back = (isset($_FILES['back'])) ? $_FILES['back'] : null;
$print->barcode = (isset($_POST['barcode'])) ? $_POST['barcode'] : null;
$print->title = (isset($_POST['title'])) ? $_POST['title'] : null;
$print->edition = (isset($_POST['edition'])) ? $_POST['edition'] : 0;

if ($print->cover && $print->title) {
	$print->coverIMG = $print->upload($print->cover);
	$print->backIMG = $print->upload($print->back);
	if ($print->title) {
		if ($print->coverIMG) {
			$addCover = $print->addByCover();
			print_r($addCover);
		}
		if ($print->barcode) {
			$addBarcode = $print->addByBarcode();
			print_r($addBarcode);
		}
	}
}