<?php 
//print_r($_List);

if (isset($_POST['genres'])) {
	$genres = $_POST['genres'];
} else $genres = false;

$stmt = $book->readAll('', $genres);
$_List = $book->all_list;

if (count($_List) <= 0) {
	$ar['data'][] = array(
		'',
		'Không có dữ liệu'
	);
} else {
foreach ($_List as $bK => $bO) {
	$isUID = ($bO['uid']) ? 1 : 0;
	$ratings = $stick = '';
	for ($i = 1; $i <= 5; $i++) {
		if ($bO['averageRate'] > $i && $bO['averageRate'] < ($i+1)) $ratings .= '<i class="fa fa-star-half-o"></i>';
		else if ($bO['averageRate'] < $i) $ratings .= '<i class="fa fa-star-o"></i>';
		else $ratings .= '<i class="fa fa-star"></i>';
	};
	if ($bO['published'] == 1) $stick .= '<div title="Tác phẩm này đã được xuất bản" class="one-book-published"></div>';
	if ($bO['uid']) $stick .= '<div title="Tác phẩm này được viết bởi thành viên của mBook" class="one-book-written"></div>';
	
	$ar['data'][] = array(
		$bO['last_chapter'],
		'<div data-published="'.$bO['published'].'" data-uid="'.$isUID.'" class="box one-book">
		<div class="box-body">
			<div class="one-book-thumb">
				<div class="one-book-details">
					<div class="one-book-chapters center hidden">
						<span>'.$bO['chaptersNum'].'</span> chương
					</div>
					<div class="one-book-genres center">
						'.$bO['genresText'].'
					</div>
				</div>
				<div class="feed-share share-book hidden">
					<a href="#share">
						<strong>'.$bO['shareNum'].'</strong>
						share
					</a>
				</div>
				<img class="book-thumb" src="'.$bO['thumb'].'"/>
			</div>
			<div class="one-book-info">
				<h2 class="one-book-title">
					<a title="'.$bO['title'].' - '.$bO['created'].'" href="'.$bO['link'].'">
						'.$bO['title'].'
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
			<div class="feed-ratings stat-one">
				<strong class="text-warning">'.$bO['averageRate'].'</strong>
				<span class="ratings text-warning">
					'.$ratings.'
				</span>
				<a class="gensmall" href="'.$bO['link'].'/reviews'.'">('.$bO['totalReview'].' reviews)</a>
			</div>
			<div class="clearfix"></div>
		</div>
</div>'
	);
}
}
echo json_encode($ar);
 ?>