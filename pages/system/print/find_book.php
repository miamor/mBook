<?php
/* SEARCH BY BARCODE */
// code to read barcode here
$barcode = 5000204892734;

// search book by barcode by accessing database


/* SEARCH BY COVER */
/* read upload img and resize 
 * if width > height => width = 800
 * else if height > width => height = 800
 (1) */

/* run detect_crop.py to crop book image
 * or use itself if img after crop return false
 (2) */
// removed this function, allow users to crop image himself

/* get image hash using pHash javascript 
 * (sending data to ?do=get_pHash) 
 (3) */

/* run classifier (books.py) to detect 
 * if this image belongs to any book title 
 (4) */

/* save data 
 * contains hash key (generated in javascript) and book title got from (4)
 * to books.txt for next time run the classification function
 (5) */

/* add to data */
$bAr = array('1-00','2-00','3-00','4-00','5-00');
$k = array('1-00','2-00','3-00','4-00','5-00');
foreach ($bAr as $k => $bO) {
	$print->img = MAIN_PATH.'/data/img/test/'.$bO.'.jpg';
	$print->title = $tAr[$k];
	$ar = $print->add();
	print_r($ar);
}
