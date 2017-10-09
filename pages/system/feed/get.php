<?php
$pageNum = ($config->get('page')) ? $config->get('page') : 0;

$feed->readAll(null, null , $pageNum);
$_List = $feed->all_list;

foreach ($_List as $oGk => $oGf) {
	$num = $oGf['num'];
	unset($oGf['num']);
	$author = $oGf[0]['author'];
	$type = $typeTxt = $oGf[0]['type'];
	if (!$type) $type = 'status';
	if ($type == 'chapter-w') $typeTxt = 'bài viết';
	
	if ($type != 'status') echo '<div class="one-group-feed group-'.$type.'">
		<div class="one-group-feed-note">
			<a class="feed-note-avt left" href="'. $author['link'] .'" data-online="'. $author['online'] .'">
				<img class="left img-circle" src="'.$author['avatar'].'">
			</a>
			<div class="feed-note-content left feed-rv">
				<a class="feed-note-user" href="'.$author['link'].'">'.$author['name'].'</a> đã thêm <span class="text-note">'.$num.' '.$typeTxt.'</span>
			</div>
			<div class="clearfix"></div>
		</div>';
	if ($type != 'status' && $num > 1) {
		echo '<div class="change-button prev-button"></div>
			<div class="change-button next-button"></div>';
	}
	
	foreach ($oGf as $ok => $oF) {
		$cls = 'active';
		if ($type != 'status' && $ok != 0) $cls = 'hide';
		if ($type == 'chapter' || $type == 'chapter-w') $diid = $oF['ilink'];
		else if ($type == 'status') $diid = $oF['id'];
		else $diid = $oF['iid'];
		echo '<div data-type="'.$type.'" data-iid="'.$diid.'" class="'.$cls.' feed-load"><span class="feed-href hidden">'.$oF['href'].'</span></div>';
	}
	
	if ($type != 'status') echo '</div>';
}
