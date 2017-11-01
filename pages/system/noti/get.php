<?php
$notiList = $noti->readAll();
foreach ($notiList as $oneNoti) {
//	print_r($oneNoti);
	extract($oneNoti);
	$img = '';
	echo '<div class="one-noti" data-new="'.$is_new.'" data-id="'.$id.'">';
	if ($from_uid) echo '<img class="one-noti-user-avatar" src="'.$author['avatar'].'"/>';
	echo '<div class="one-noti-content">';
//	echo '['.$type.'] ';

	if ($type == 'welcome') {
		$icon = 'bullhorn';
		echo 'Chào mừng bạn đến với mBook. Hãy xem qua hướng dẫn của chúng tôi để bắt đầu! <a class="noti-post-link" href="'.MAIN_URL.'/start">Start <i class="fa fa-caret-square-o-right"></i></a>';
	}
	else if ($type == 'rate-review') {
		$icon = 'star';
		echo '<a href="one-noti-user-name" href="'.$author['link'].'">'.$author['name'].'</a> đánh giá <b>'.$content['rate'].'<i class="fa fa-star" style="font-size:12px;margin-left:2px"></i></b> cho bài <a class="noti-post-link" href="'.MAIN_URL.'/review/'.$content['review_id'].'">đánh giá sách ('.$content['book_title'].')</a> của bạn: <span class="one-noti-quote">"'.$content['content'].'"</span>.';
	}
	else if ($type == 'rate-chapter') {
		$icon = 'star';
//		$details = $noti->getBookChapter($iid);
		echo '<a href="one-noti-user-name" href="'.$author['link'].'">'.$author['name'].'</a> đánh giá <b>'.$content['rate'].'<i class="fa fa-star" style="font-size:12px;margin-left:2px"></i></b> cho bài viết <a class="noti-post-link" href="'.MAIN_URL.'/write/'.$content['book_id'].'/chapters/'.$content['chapter_id'].'">'.$content['chapter_title'].' ('.$content['book_title'].')</a> của bạn: <span class="one-noti-quote">"'.$content['content'].'"</span>.';
	}
	else if ($type == 'comment-post') {
		$icon = 'comment';
		echo '<a href="one-noti-user-name" href="'.$author['link'].'">'.$author['name'].'</a> bình luận trong <a class="noti-post-link" href="'.MAIN_URL.'/status/'.$content['post_id'].'">bài viết</a> của bạn: <span class="one-noti-quote">"'.$content['content'].'"</span>.';
	}
	else if ($type == 'share-post') {
		$icon = 'facebook-square';
		echo '<a href="one-noti-user-name" href="'.$author['link'].'">'.$author['name'].'</a> chia sẻ <a class="noti-post-link" href="'.MAIN_URL.'/status/'.$content['post_id'].'">bài viết</a> của bạn trên <a class="noti-post-link" href="https://www.facebook.com/'.$content['fb_post_id'].'">facebook</a>.';
	}
	else if ($type == 'like-post') {
		$icon = 'thumbs-up';
		echo '<a href="one-noti-user-name" href="'.$author['link'].'">'.$author['name'].'</a> ';
		if ($content['post_total_likes'] > 1) echo 'và '.($content['post_total_likes']-1).' người khác ';
		echo 'thích <a class="noti-post-link" href="'.MAIN_URL.'/status/'.$content['post_id'].'">bài viết</a> của bạn: <span class="one-noti-quote">"'.$content['content'].'"</span>.';
	}

	else if ($type == 'finish-buy') {
		$icon = 'check';
		echo 'Bạn đã hoàn thành việc mua sách ở <a class="noti-post-link" href="'.$config->boxLink.'/'.$post_id.'">box #'.$post_id.': '.$content['box_title'].'</a>.';
	}
	else if ($type == 'new-review') {
		$img = '<img style="margin-top:-6px" src="'.IMG.'/silk/coins.png"/>';
		$icon = 'check';
		echo 'Bạn được cộng thêm '.$img.'<b>'.$content['coins_added'].'</b> vì thêm một <a class="noti-post-link" href="'.$config->rLink.'/'.$iid.'">review mới cho sách "'.$content['book_title'].'"</a> thành công.';
	}
	else if ($type == 'add-coin-returned') {
		$img = '<img style="margin-top:-6px" src="'.IMG.'/silk/coins.png"/>';
		$icon = 'check';
		echo 'Cảm ơn bạn đã mượn và trả sách. Bạn vừa được cộng thêm '.$img.'<b>'.$content['coins_added'].'</b> vì tham gia chương trình chia sẻ sách của hệ thống.
		<div class="note">Bạn có thể viết <a class="noti-post-link" href="'.$config->rLink.'?mode=new">review</a> cho cuốn sách vừa mượn để nhận thêm điểm. <a class="noti-post-link" href="'.$config->rLink.'?mode=new"><i class="fa fa-toggle-right"></i></a></div>';
	}
	else if ($type == 'new-chapter') {
		$img = '<img style="margin-top:-6px" src="'.IMG.'/silk/coins.png"/>';
		$icon = 'check';
		echo 'Bạn được cộng thêm '.$img.'<b>'.$content['coins_added'].'</b> vì thêm một <a class="noti-post-link" href="'.$config->bLink.'/'.$content['book_id'].'/chapters/'.$content['chapter_id'].'">bài viết mới</a> thành công.';
	}

	echo '</div>'; // one-noti-content
	echo ($from_uid) ? '<div class="one-noti-time">' : '<div class="one-noti-time" style="margin-left:0">';
	echo ($img) ? $img.' ' : '<i class="fa fa-'.$icon.'"></i>';
	echo $created.'
	</div>
	<div class="clearfix"></div>';
	echo '</div>';
}
