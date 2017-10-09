<div class="feed-one-item feed-item-status">
	<div class="feed-user-info col-lg-1 no-padding centered">
		<a href="<?php echo $author['link'] ?>" data-online="<?php echo $author['online'] ?>">
			<img class="feed-user-avt img-circle" src="<?php echo $author['avatar'] ?>">
		</a>
	</div>
	<div class="feed-content col-lg-9 no-padding feed-stt">
		<div class="box box-status feed-main col-lg-12 feed-stt-main">
			<div class="box-header feed-main-head feed-stt-head">
				<a href="<?php echo $author['link'] ?>"><?php echo $author['name'] ?></a>
				<?php if ($gid) echo ' <i class="fa fa-caret-right to-caret"></i> <a href="'.$gIn['link'].'">'.$gIn['title'].'</a>' ?>
			</div>
			<div class="box-body feed-main-content feed-stt-content">
				<?php echo $content_feed ?>
			</div>

			<div class="box-footer stat feed-sta">
				<div class="feed-likes text-success stat-one col-lg-4 no-padding">
					<a id="<?php echo $post->id ?>" class="post-like <?php if ($post->myLike) echo 'liked' ?>" href="#"><i class="fa fa-thumbs-up"></i>
					<strong><?php echo $likesNum ?></strong>
					likes
					</a>
				</div>
				<div class="feed-comments text-danger stat-one col-lg-4 no-padding text-center">
					<a class="text-danger" href="<?php echo $link ?>"><strong><?php echo $ratingsNum ?></strong>
					comments</a>
				</div>
				<div class="feed-share text-info stat-one col-lg-4 no-padding text-right">
				<?php if ($post->checkMyShareFB()) echo '<a class="shared"><i class="fa fa-check"></i> <strong id="share_num_status_'. $id .'">'.$shareNum .'</strong> Share</a>';
				else echo '<a class="share" data-param="link='. $link.'&amp;app_id='. FB_APP_ID .'&amp;redirect_uri='. $link.'?do=shareFB"><strong id="share_num_status_'. $id .'">'. $shareNum .'</strong> Share</a>'; ?>
				</div>
			</div>
			
			<div class="box-footer box-likes-show <?php if (!$likesNum) echo 'hide' ?>" id="post-likes">
				<div class="box-likes-show-text"><?php echo $likeShow ?></div>
			</div>
			
			<div class="box-footer box-comments">
<?php 	include 'pages/views/_temp/cmtList.feed.php';
		$fType = 'status'; $fID = $post->id;
		include 'pages/views/_temp/cmtForm.feed.php' ?>
			</div><!-- /.box-footer -->
		</div>
		<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
</div>
