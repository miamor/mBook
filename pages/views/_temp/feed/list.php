<form class="col-lg-2 filters no-padding">
	<h3>Lọc kết quả</h3>
	<div class="filter-author-type">
		<div class="filter-body">
			<label class="radio">
				<input type="radio" value="1" name="auth_type"/> My followings
			</label>
			<label class="radio">
				<input type="radio" value="0" checked name="auth_type"/> Everything
			</label>
		</div>
	</div>
	<div class="filter-post-type">
		<h4 class="filter-header with-border">Post type</h4>
		<div class="filter-body">
			<label class="checkbox">
				<input type="checkbox" value="status" checked name="post_type"/> Status
			</label>
			<label class="checkbox">
				<input type="checkbox" value="review" checked name="post_type"/> Review
			</label>
			<label class="checkbox">
				<input type="checkbox" value="write" checked name="post_type"/> Chuyên mục viết
			</label>
<!--			<label class="checkbox">
				<input type="checkbox" value="event" checked name="post_type"/> Sự kiện
			</label>
			<label class="checkbox">
				<input type="checkbox" value="request" checked name="post_type"/> Đề nghị
			</label>
			<label class="checkbox">
				<input type="checkbox" value="4" checked name="post_type"/> Chia sẻ để nhận
			</label>
			<label class="checkbox">
				<input type="checkbox" value="5" checked name="post_type"/> Lấy ý kiến
			</label>
-->		</div>
	</div>
	<div class="filter-author-type">
		<h4 class="filter-header with-border">#Trends</h4>
		<div class="filter-body">
<?php foreach ($hashtagList as $oneHashtag) {
		echo '<a class="one-hashtag" href="#">#'.$oneHashtag['hashtag'].'</a> ';
	} ?>
			<div class="input-hashtag">
				<input type="text" class="form-control" placeholder="Or input a hashtag"/>
			</div>
		</div>
	</div>
	<div class="add-form-submit center">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>
</form>

<div class="col-lg-10 feed-items no-padding-right">

<div class="col-lg-8 no-padding-left">
<?php include 'pages/views/_temp/v.form.php'; ?>
<div id="fb_friends"></div>
<div id="events">
	<div class="clearfix"></div>
</div>
</div>
<!--<div class="col-lg-4 no-padding-right feed-advertise">
	<div class="box">
		<div class="box-body text-center" style="height:300px">Advertisement</div>
	</div>
</div>-->
<div class="clearfix"></div>

<div id="post-list" class="feed-items">
<?php //print_r($_List);
foreach ($_List as $oGk => $oGf) {
	$num = $oGf['num'];
	unset($oGf['num']);
	$author = $oGf[0]['author'];
	$type = $typeTxt = $oGf[0]['type'];
	if ($type == 'chapter-w') $typeTxt = 'bài viết';
//	print_r($oGf);
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
		$diid = ($type == 'chapter' || $type == 'chapter-w') ? $oF['ilink'] : $oF['iid'];
		echo '<div data-type="'.$oF['type'].'" data-iid="'.$diid.'" class="'.$cls.' feed-load"><span class="feed-href hidden">'.$oF['href'].'</span></div>';
	}

	if ($type != 'status') echo '</div>';
} ?>
</div>

</div>

<div class="clearfix"></div>
