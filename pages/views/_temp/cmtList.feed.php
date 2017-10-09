<?php
if ($ratingsNum > 0) {
	if ($ratingsNum > 2) echo '<div class="box-comment"><div class="comment-text"><a href="'.$link.'#comments"><i class="fa fa-refresh"></i> Xem tất cả '.$ratingsNum.' bình luận</a></div></div>';
	foreach ($ratingsList as $rO) { ?>
	<div class="box-comment">
		<div class="box-comment-left">
			<a href="<?php echo $rO['author']['link'] ?>" data-online="<?php echo $rO['author']['online'] ?>" class="left">
				<img class="img-sm img-circle" src="<?php echo $rO['author']['avatar'] ?>">
			</a>
		</div>
		<div class="comment-text">
			<span class="username">
				<a href="<?php echo $rO['author']['link'] ?>"><?php echo $rO['author']['name'] ?></a>
			<?php if (isset($rO['rate'])) { ?>
				<span class="ratings text-warning">
				<?php for ($i = 1; $i <= 5; $i++) {
					if ($rO['rate'] > $i && $rO['rate'] < ($i+1)) echo '<i class="fa fa-star-half-o"></i>';
					else if ($rO['rate'] < $i) echo '<i class="fa fa-star-o"></i>';
					else echo '<i class="fa fa-star"></i>';
				} ?>
				</span>
				<span class="coins-plus" title="Review của <?php echo $rO['author']['name'] ?> đã cộng thêm cho <?php echo $parentPageView['author']['name'] ?> <?php echo $rO['coins'] ?> điểm">
					<span class="text-success">+<?php echo $rO['coins'] ?></span>
				</span>
			<?php } ?>
				<span class="text-muted pull-right"><?php echo $rO['created'] ?></span>
			</span><!-- /.username -->
			<?php echo $rO['content_feed'] ?>
		</div><!-- /.comment-text -->
	</div><!-- /.box-comment -->
<?php }
}
