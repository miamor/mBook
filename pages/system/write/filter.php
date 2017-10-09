<?php 
//print_r($_List);

$genresAr = array();
if (isset($_POST['genres'])) {
	foreach ($_POST['genres'] as $oneGen)
		$genresAr[] = $oneGen;
//	$genres = $_POST['genres'];
}

$start = isset($_POST['start']) ? $_POST['start'] : 0;
$records = isset($_POST['records']) ? $_POST['records'] : 24;
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : null;
$authorAr = array();
if (isset($_POST['author'])) {
	foreach ($_POST['author'] as $oneAu)
		$authorAr[] = $oneAu;
}

$stmt = $book->readAll('', $genresAr, $authorAr, '', $start, $records, $keyword);
$_List = $book->all_list;
$num = $book->countAll('', $genresAr, $authorAr, $keyword);
//$num = count($_List);

$pageHTML = '';

if ($num <= 0) {
	$ar[] = 'Không có dữ liệu';
} else {
	$pages = ceil($num/$records)-1;
	$pageHTML = '<ul class="pagination right">';
	
	$prevSt = $start - $records;
	if ($prevSt <= 0) $pageHTML .= '<li class="paginate_button previous disabled" id="book-list_previous"><a href="#">Previous</a></li>';
	else $pageHTML .= '<li class="paginate_button previous" id="book-list_previous"><a href="?start='.$prevSt.'&records='.$records.'">Previous</a></li>';
	
	$currentPage = $start/$records;
	
	if ($pages <= 3) {
		$pageHTML .= $book->showPages(0, $records, $pages, $start);
	} else {
		if ($start <= 1*$records) {
			$pageHTML .= $book->showPages(0, $records, 1, $start);
		} else $pageHTML .= $book->showPages(0, $records, 0, $start);

		if ($start > ($pages-1)*$records) { // page last/last
			$pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
			$pageHTML .= $book->showPages($pages-1, $records, $pages, $start);
		} 
		else if ($start > ($pages-2)*$records) { // page (last-1)/last
			$pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
			$pageHTML .= $book->showPages($currentPage-1, $records, $pages, $start);
		} 
		else if ($start > ($pages-3)*$records) { // page (last-2)/last
			$pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
			$pageHTML .= $book->showPages($currentPage-1, $records, $pages, $start);
		} 
		else {
			if ($start >= 2*$records) {
				if ($start > 2*$records) $pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
				$pageHTML .= $book->showPages($currentPage-1, $records, $currentPage+1, $start);
			} else if ($start > 0) {
				$pageHTML .= $book->showPages(2, $records, 3, $start);
			}
			// last pages
			$pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
			$pageHTML .= $book->showPages($pages, $records, $pages, $start);
		}
	}
	
	$nextSt = $start + $records;
	if ($nextSt > $num) $pageHTML .= '<li class="paginate_button next disabled" id="book-list_next"><a href="#">Next</a></li>';
	else $pageHTML .= '<li class="paginate_button next" id="book-list_next"><a href="?start='.$nextSt.'&records='.$records.'">Next</a></li>';
	
	$pageHTML .= '</ul>';
	
foreach ($_List as $bK => $bO) {
	$isUID = ($bO['uid'] > 0 && $bO['type'] == 0) ? 1 : 0;
	$ratings = $stick = '';
	for ($i = 1; $i <= 5; $i++) {
		if ($bO['averageRate'] > $i && $bO['averageRate'] < ($i+1)) $ratings .= '<i class="fa fa-star-half-o"></i>';
		else if ($bO['averageRate'] < $i) $ratings .= '<i class="fa fa-star-o"></i>';
		else $ratings .= '<i class="fa fa-star"></i>';
	};
	if ($bO['published'] == 1) $stick .= '<div title="Tác phẩm này đã được xuất bản" class="one-book-published"></div>';
	if ($bO['type'] == 0 && $bO['uid']) $stick .= '<div title="Tác phẩm này được viết bởi thành viên của mBook" class="one-book-written"></div>';
	if ($bO['type'] == 1) $stick .= '<div title="Đây là một chủ đề" class="one-book-topic"></div>';
	
	if ($bO['type'] == 0) {
		$chapNumTxt = '<div class="one-book-chapters center">
						<span>'.$bO['chaptersNum'].'</span> chương
					</div>';
		$stat = '<div class="feed-ratings stat-one">
				<strong class="text-warning left">'.$bO['averageRate'].'</strong>
				<span class="ratings text-warning left">
					'.$ratings.'
				</span>
				<a class="gensmall" href="'.$bO['link'].'/reviews'.'">('.$bO['totalReview'].' reviews)</a>
			</div>';
	} else { // is topic
		$chapNumTxt = '';
		$stat = '<div class="feed-ratings topic-replies">
				<strong class="text-success">'.$bO['chaptersNum'].'</strong>
				bài viết
			</div>';
	}
	
	$ar[] = '<div class="col-lg-3 no-padding-right"><div data-published="'.$bO['published'].'" data-uid="'.$isUID.'" data-topic="'.$bO['type'].'" data-id="'.$bO['id'].'" class="box one-book">
		<div class="box-body">
			<div class="one-book-thumb">
				<div class="one-book-details">
					'.$chapNumTxt.'
					<div class="one-book-genres center">
						'.$bO['genresText'].'
					</div>
				</div>
				<img class="book-thumb" src="'.$bO['thumb'].'"/>
			</div>
			<div class="one-book-info">
				<h2 class="one-book-title">
					<a title="'.$bO['title'].'" href="'.$bO['link'].'">
						'.str_replace(mb_strtolower($keyword), '<b>'.mb_strtolower($keyword).'</b>', mb_strtolower($bO['title'])).'
					</a>
				</h2>
				<div class="one-book-status right">
					<b>'.$bO['sttTextIcon'].'</b> 
				</div>
				<div class="one-book-author">
					<a href="'.$bO['author']['link'].'">'.$bO['author']['name'].'</a>
				</div>
			</div>
			'.$stick.'
			<div class="clearfix"></div>
		</div>
		<div class="box-footer stat feed-sta">
			'.$stat.'
			<div class="clearfix"></div>
		</div>
</div></div>';

}
}
echo $pageHTML.'<div class="clearfix"></div>';
echo '<div class="book-list">'.implode('', $ar).'</div>';
echo '<div class="clearfix"></div><div class="left results-show">Hiển thị từ '.($start+1).' đến '.($start+$records).' trong tổng số '.$num.' kết quả</div> '.$pageHTML.'<div class="clearfix"></div>';
 ?>
