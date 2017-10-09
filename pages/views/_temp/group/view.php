<div class="group-info">

	<div class="col-lg-3 publisher-sidebar">
		<img class="publisher-avatar" src="<?php echo $avatar ?>">
		<h2 class="publisher-title"><?php echo $title ?></h2>
		<div class="publisher-uname">#<?php echo $code ?></div>

		<ul class="publisher-navigate hidden">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Reviews</a></li>
		</ul>
		
		<div class="group-members">
			<div class="group-members-count col-lg-3 no-padding-left" title="<?php echo $memNum ?> thành viên">
				<?php echo $memNum ?>
			</div>
			<div class="group-members-ar col-lg-9 no-padding-right">
				<?php foreach ($memAr as $oM) {
					echo '<a href="'.$oM['link'].'" data-online="'.$oM['online'].'" title="'.$oM['name'].'"><img class="group-member-thumb" src="'.$oM['avatar'].'"/></a>';
				} ?>
			</div>
			<div class="clearfix"></div>
		</div>
		
		<div class="group-buttons">
			<?php echo '<a id="join" class="btn btn-block btn-red" data-join="'.$group->isMember.'">';
			echo (!$group->isMember) ? 'Tham gia nhóm' : 'Rời khỏi nhóm';
			echo '</a>' ?>
		</div>

		<div class="box group-about" style="margin-top:20px">
			<div class="box-header with-border">About</div>
			<div class="box-body group-about-content">
				<?php echo content(substr(htmlspecialchars(strip_tags($des)), 0, 240)).'... <a href="'.$link.'/about" class="small">See more</a>'; ?>
			</div>
		</div>
	</div>

	<div class="col-lg-9 no-padding group-main">
		<?php if ($group->isMember) include 'pages/views/_temp/v.form.php'; ?>
		<div id="post-list" class="feed-items">
		<?php foreach ($postList as $oF) {
			echo '<div data-type="'.$oF['type'].'" data-iid="'.$oF['iid'].'" class="feed-load"><span class="feed-href hidden">'.$oF['href'].'</span></div>';
		} ?>
		</div>
	</div>
	
	<div class="clearfix"></div>
</div>

