<img class="book-thumb" src="<?php echo $thumb ?>"/>

<?php if ($type == 0) { ?>
<div class="book-rate">
	<div class="book-score left text-warning">
		<?php echo $book->averageRate ?>
	</div>
	<div class="book-ratings-details">
		<div class="ratings book-ratings text-warning">
		<?php for ($i = 1; $i <= 5; $i++) {
			if ($book->averageRate > $i && $book->averageRate < ($i+1)) echo '<i class="fa fa-star-half-o"></i>';
			else if ($book->averageRate < $i) echo '<i class="fa fa-star-o"></i>';
			else echo '<i class="fa fa-star"></i>';
		} ?>
		</div>
		<a href="<?php echo $link.'/reviews' ?>" title="View all <?php echo $book->totalReview ?> reviews" class="gensmall">(<?php echo $book->totalReview ?> reviews)</a>
	</div>
</div>
<?php if ($ratingsNum <= 0) {
	echo '<a class="btn btn-block btn-red" style="margin-top:15px" href="'.$config->rLink.'?mode=new&book='.$id.'"><i class="fa fa-plus"></i> Thêm đánh giá</a>';
} ?>

<div class="book-details no-padding">
	<div class="book-genres">
		<b>Thể loại:</b> <?php echo $genresText ?>
	</div>
<?php if (!$uid) { ?>
	<div class="book-authors">
		<b>Tác giả:</b> <a href="<?php echo $author['link'] ?>"><?php echo $author['name'] ?></a>
	</div>
<?php } else { ?>
	<div class="book-status">
		<b>Tình trạng:</b> <?php echo $sttText ?>
	</div>
<?php } ?>
</div>
<?php } ?>

<?php if ($uid) {
	if ($type == 0) echo '<div class="alerts alert-info">
	Cuốn sách này được viết bởi thành viên của mBook
</div>' ?>
<div class="book-author">
	<h4 class="about-book-author"><?php if ($type == 0) echo 'Về tác giả'; else echo 'Tạo chủ đề' ?></h4>
	<div class="clearfix"></div>
	<a class="left" data-online="<?php echo $author['online'] ?>" href="<?php echo $author['link'] ?>">
		<img class="user-avatar" src="<?php echo $author['avatar'] ?>"/>
	</a>
	<div class="user-name">
		<div class="book-author-name"><a href="<?php echo $author['link'] ?>"><?php echo $author['name'] ?></a></div>
		<div class="button-follow btn-group">
			<div class="btn btn-follow btn-red btn-sm">
				<span class="fa fa-eye"></span> Follow
			</div>
			<div class="btn btn-default btn-sm num-follow" title="Followers">2</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<?php } ?>

<?php 
if ($type == 0) {
if ($status == 0) {
	echo '<div class="book-buttons"><div class="alerts alert-info">Tác phẩm chưa hoàn thành. Bạn chưa thể download ebook hay đề nghị xuất bản.</div></div>';
} else {
	if ($download) { ?>
<div class="book-download-links">
	<div class="report-link right">
		<a href="<?php echo $book->link.'/report_link?v=feed' ?>" class="gensmall">Báo cáo link hỏng</a>
	</div>
	<label class="download-label">Download</label>
	<?php foreach ($bView['download'] as $k => $oneLink) 
		echo '<a class="one-link" href="'.$oneLink.'">Link '.($k+1).'</a>'; ?>
	<div class="clearfix"></div>
<!--	<a class="btn add-to-cart btn-red" href="<?php echo $download ?>" target="_blank"><i class="fa fa-download"></i> Download</a> 
<!--	<a class="btn add-to-cart btn-default"><i class="fa fa-download"></i> Free samples</a>
	<a class="btn add-to-cart btn-red"><i class="fa fa-download"></i> Purchase (550$)</a> -->
</div>
	<?php } ?>
<div class="book-requests">
<?php if ($published) { ?>
	<div class="console info">
		<div class="csl-main">Cuốn sách này đã được xuất bản.</div>
	</div>
<?php } else { ?>
	<div class="console info">
		<div class="csl-main">Cuốn sách này chưa được xuất bản.</div>
	</div>
	<a class="btn btn-block btn-red"><i class="fa fa-ticket"></i> Đề nghị xuất bản</a>
<?php } ?>
</div>
<?php }
} ?>

<div class="share-buttons no-padding text-right">
	<a href="#" class="share-fb fa fa-facebook-square"></a>
	<a href="#" class="share-tt fa fa-twitter-square"></a>
</div>
