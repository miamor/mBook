<div class="feed-one-item feed-item-status">
	<div class="feed-user-info col-lg-1 no-padding centered">
		<a href="<?php echo $author['link'] ?>" data-online="<?php echo $author['online'] ?>">
			<img class="feed-user-avt img-circle" src="<?php echo $author['avatar'] ?>">
		</a>
	</div>
	<div class="feed-content col-lg-11 no-padding feed-stt">
		<div class="box box-status feed-main col-lg-8 feed-stt-main">
			<div class="box-header feed-main-head feed-stt-head">
				<a href="<?php echo $author['link'] ?>"><?php echo $author['name'] ?></a>
				<?php if ($gid) echo ' <i class="fa fa-caret-right to-caret"></i> <a href="'.$group['link'].'">'.$group['title'].'</a>' ?>
			</div>
			<div class="box-body feed-main-content feed-stt-content">
				<?php echo $content_feed ?>
			</div>

			<div class="box-footer stat feed-sta">
				<div class="feed-likes text-success stat-one col-lg-4 no-padding">
					<strong><?php echo $likesNum ?></strong>
					likes
				</div>
				<div class="feed-comments text-danger stat-one col-lg-4 no-padding text-center">
					<strong><?php echo $ratingsNum ?></strong>
					comments
				</div>
				<div class="feed-share text-info stat-one col-lg-4 no-padding text-right">
					<a href="#share">
						<strong><?php echo $shareNum ?></strong>
						share
					</a>
				</div>
			</div>
			
			<div class="box-footer box-comments">
	<?php 	include 'pages/views/_temp/cmtList.feed.php';
			include 'pages/views/_temp/cmtForm.feed.php' ?>
			</div><!-- /.box-footer -->
		</div>
		<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
</div>
