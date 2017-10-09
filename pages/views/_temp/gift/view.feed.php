<div class="feed-one-item feed-item-gift">
	<div class="feed-user-info col-lg-1 no-padding centered">
		<a href="<?php echo $author['link'] ?>" title="<?php echo $author['name'] ?>" data-online="<?php echo $author['online'] ?>">
			<img class="feed-user-avt img-circle" src="<?php echo $author['avatar'] ?>"/>
		</a>
	</div>
	<div class="feed-content col-lg-11 no-padding feed-gift">
		<div class="box box-gift feed-main col-lg-8 feed-gift-main">
			<div class="box-header feed-main-head feed-gift-head">
				<a href="<?php echo $author['link'] ?>" title="<?php echo $author['name'] ?>"><?php echo $author['name'] ?></a> sẽ tặng <strong class="text-success">1</strong> cuốn sách cho người chia sẻ bài viết <a class="text-info" href="#" title="What's this?"><i class="fa fa-info-circle"></i></a>
			</div>
			<div class="box-body feed-main-content feed-gift-content">
				<?php echo $content_feed ?>
			</div>

			<div class="box-footer stat feed-sta">
				<div class="feed-cmts text-danger stat-one col-lg-6 no-padding">
					<strong><?php echo $ratingsNum ?></strong>
					comments
				</div>
				<div class="feed-share text-info stat-one col-lg-6 no-padding text-right">
					<a href="#share">
						<strong><?php echo $shareNum ?></strong>
						share
					</a>
				</div>
			</div>
			
		<?php if ($ratingsNum > 0) { ?>
			<div class="box-footer box-comments">
			<?php foreach ($ratingsList as $rO) { ?>
				<div class="box-comment">
					<div class="box-comment-left">
						<a href="<?php echo $rO['author']['link'] ?>" data-online="<?php echo $rO['author']['online'] ?>" class="left">
							<img class="img-sm img-circle" src="<?php echo $rO['author']['avatar'] ?>">
						</a>
					</div>
					<div class="comment-text">
						<span class="username">
							<a href="<?php echo $rO['author']['link'] ?>"><?php echo $rO['author']['name'] ?></a>
							<span class="text-muted pull-right"><?php echo $rO['created'] ?></span>
						</span><!-- /.username -->
						<?php echo $rO['content'] ?>
					</div><!-- /.comment-text -->
				</div><!-- /.box-comment -->
			<?php } ?>
			</div><!-- /.box-footer -->
		<?php } ?>

		</div>
		<div class="col-lg-4 no-padding-right feed-gift-book">
			<div class="books">
				<div class="books-one-thumb col-lg-4 active">
					<img class="book-thumb" src="http://localhost/mBook/data/img/b2.png"/>
				</div>
				<div class="books-one-thumb col-lg-4">
					<img class="book-thumb" src="http://localhost/mBook/data/img/b1.png"/>
				</div>
				<div class="books-one-thumb col-lg-4">
					<img class="book-thumb" src="http://localhost/mBook/data/img/b3.png"/>
				</div>
				<div class="clearfix"></div>
			</div>
			
			<div class="book-one" id="2">
				<div class="book-rate">
					<div class="book-score left text-warning">
						4.5
					</div>
					<div class="book-ratings-details">
						<div class="ratings book-ratings text-warning">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-half-o"></i>
							<i class="fa fa-star-o"></i>
						</div>
						<a href="#" title="View all 15 reviews" class="gensmall">(15 reviews)</a>
					</div>
				</div>
				<div class="book-details no-padding">
					<div class="">
						<div class="book-genres">
							<b>Thể loại:</b> <a href="#">Lãng mạn</a>, <a href="#">Hiện thực</a>, <a href="#">Đời thường</a>
						</div>
						<div class="book-genres">
							<b>Tác giả:</b> <a href="#">Auth name</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="box given">
				<div class="box-body" title="Tu Nguyen won this ticket">
					<a class="left img-circle" data-online="0" href="#">
						<img class="img-sm img-circle" src="http://localhost/bonita/data/img/Paris-5.jpg">
					</a>
					<a href="#">Tu Nguyen</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
			
		<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
</div>
