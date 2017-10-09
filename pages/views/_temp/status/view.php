<div class="col-lg-1"></div>

<div class="status-info col-lg-10 no-padding feed-one-item feed-item-status feed-load" data-type="status" data-iid="<?php echo $id ?>">
	<div class="feed-user-info col-lg-1 no-padding centered">
		<a href="<?php echo $author['link'] ?>" data-online="<?php echo $author['online'] ?>">
			<img class="feed-user-avt img-circle" src="<?php echo $author['avatar'] ?>">
		</a>
	</div>
	<div class="feed-content col-lg-11 no-padding feed-stt">
		<div class="box box-status feed-main col-lg-8 feed-stt-main">
			<div class="box-header feed-main-head feed-stt-head">
<!--				<a href="<?php echo $author['link'] ?>"><?php echo $author['name'] ?></a> đã thêm 1 <a href="<?php echo $link ?>">status</a> -->
				<a href="<?php echo $author['link'] ?>"><?php echo $author['name'] ?></a>
				<?php if ($gid) echo ' <i class="fa fa-caret-right to-caret"></i> <a href="'.$gIn['link'].'">'.$gIn['title'].'</a>' ?>
			</div>
			<div class="box-body feed-main-content feed-stt-content">
				<?php echo $content ?>
			</div>

			<div class="box-footer stat feed-sta">
				<div class="feed-likes text-success stat-one col-lg-4 no-padding">
					<a id="<?php echo $post->id ?>" class="post-like <?php if ($post->myLike) echo 'liked' ?>" href="#"><i class="fa fa-thumbs-up"></i>
					<strong><?php echo $likesNum ?></strong>
					likes
					</a>
				</div>
				<div class="feed-comments text-danger stat-one col-lg-4 no-padding text-center">
					<strong><?php echo $ratingsNum ?></strong>
					comments
				</div>
				<div class="feed-share text-info stat-one col-lg-4 no-padding text-right">
				<?php if ($post->checkMyShareFB()) echo '<a class="shared"><i class="fa fa-check"></i> <strong id="share_num_status_'. $id .'">'.$shareNum .'</strong> Share</a>';
				else echo '<a class="share" data-param="link='. $link.'&amp;app_id='. FB_APP_ID .'&amp;redirect_uri='. $link.'?do=shareFB"><strong id="share_num_status_'. $id .'">'. $shareNum .'</strong> Share</a>'; ?>
				</div>
			</div>
			
			<div class="box-footer box-likes-show <?php if (!$likesNum) echo 'hide' ?>" id="post-likes">
				<div class="box-likes-show-text"><?php echo $likeShow ?></div>
			</div>
			
			<div class="box-footer box-comments" id="comments">
<?php 
		if ($ratingsNum > 0) {
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
							<span class="text-muted pull-right"><?php echo $rO['created'] ?></span>
						</span><!-- /.username -->
						<?php echo $rO['content'] ?>
					</div><!-- /.comment-text -->
				</div><!-- /.box-comment -->
			<?php }
		}
		$fType = 'status'; $fID = $post->id;
		if (!$group->id || $group->isMember) include 'pages/views/_temp/cmtForm.status.php' ?>
			</div><!-- /.box-footer -->
		</div>
		
<?php if ($group->id) { ?>
	<div class="col-lg-4 group-info publisher-sidebar">
		<img class="publisher-avatar" src="<?php echo $groupInfo['avatar'] ?>">
		<h2 class="publisher-title"><?php echo $groupInfo['title'] ?></h2>
		<div class="publisher-uname">#<?php echo $groupInfo['code'] ?></div>
		
		<div class="group-members">
			<div class="group-members-count col-lg-3 no-padding-left" title="<?php echo $groupInfo['memNum'] ?> thành viên">
				<?php echo $groupInfo['memNum'] ?>
			</div>
			<div class="group-members-ar col-lg-9 no-padding-right">
				<?php foreach ($groupInfo['memAr'] as $oM) {
					echo '<a href="'.$oM['link'].'" data-online="'.$oM['online'].'" title="'.$oM['name'].'"><img class="group-member-thumb" src="'.$oM['avatar'].'"/></a>';
				} ?>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="group-buttons">
			<?php echo '<a class="btn btn-red btn-block" href="'.$group->link.'">To this group <i class="fa fa-location-arrow"></i></a>' ?>
		</div>
	</div>
<?php } ?>
		<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
</div>

<div class="col-lg-1"></div>

<div class="clearfix"></div>
