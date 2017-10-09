<div class="feed-one-item feed-item-status">
	<div class="feed-user-info col-lg-1 no-padding centered">
		<a title="<?php echo $postInfo['author']['name'] ?>" href="<?php echo $postInfo['author']['link'] ?>" data-online="<?php echo $postInfo['author']['online'] ?>">
			<img class="feed-user-avt img-circle" src="<?php echo $postInfo['author']['avatar'] ?>"/>
		</a>
	</div>
	<div class="feed-content col-lg-11 no-padding feed-stt">
		<div class="box box-status feed-main feed-stt-main">
			<div class="box-body feed-main-content feed-stt-content">
				<?php echo $postInfo['content'] ?>
			</div>

			<div class="box-footer stat feed-sta">
				<div class="feed-likes text-success stat-one col-lg-6 no-padding">
					<strong><?php echo $postInfo['likesNum'] ?></strong>
					likes
				</div>
				<div class="feed-comments text-danger stat-one col-lg-6 no-padding text-right">
					<strong><?php echo $postInfo['ratingsNum'] ?></strong>
					comments
				</div>
			</div>
			
	<?php $ratingsNum - $postInfo['ratingsNum'];
		$ratingsList = $postInfo['ratingsList'];
		include 'pages/views/_temp/cmtList.feed.php';
		include 'pages/views/_temp/cmtForm.feed.php' ?>
		
		</div>
			
		<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
</div>

