<?php foreach ($_List as $bK => $bO) {
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
			<div class="col-lg-3 one-book-thumb">
				<img class="book-thumb" src="'.$bO['thumb'].'"/>
				<div class="one-book-chapters-num">
					<span>'.$bO['chaptersNum'].'</span> chương
				</div>
			</div>
			<div class="col-lg-9 no-padding-right">
				<h2 class="one-book-title">
					<a title="'.$bO['title'].' - '.$bO['created'].'" href="'.$bO['link'].'">
						'.$bO['title'].'
					</a>
				</h2>
				<div class="one-book-des">'.$bO['des'].'</div>
				<div class="one-book-details">
					<div class="one-book-genres">
						<b>Thể loại:</b> '.$bO['genresText'].'
					</div>
					<div class="one-book-status right">
						<b>'.$bO['sttText'].'</b> 
					</div>
					<div class="one-book-author">
						<b>Tác giả:</b> <a href="'.$bO['author']['link'].'">'.$bO['author']['name'].'</a>
					</div>
				</div>
			</div>
			'.$stick.'
			<div class="clearfix"></div>
		</div>
		<div class="box-footer stat feed-sta">
			<div class="feed-ratings stat-one col-lg-6 no-padding">
				<strong class="text-warning">'.$bO['averageRate'].'</strong>
				<span class="ratings text-warning">
					'.$ratings.'
				</span>
				<a class="gensmall" href="'.$bO['link'].'/reviews'.'">('.$bO['totalReview'].' reviews)</a>
			</div>
			<div class="feed-share text-info stat-one col-lg-6 no-padding text-right">
				<a href="#share">
					<strong>'.$bO['shareNum'].'</strong>
					share
				</a>
			</div>
			<div class="clearfix"></div>
		</div>
</div>'
	);
}
echo json_encode($ar);
 ?>