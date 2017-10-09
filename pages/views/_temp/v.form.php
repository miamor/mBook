<?php if ($config->u) { ?>
<div class="nav-tabs-custom-feed">
	<ul class="nav nav-tabs-feed">
		<li class="active"><a href="#form_status" data-toggle="tab" aria-expanded="false">Status</a></li>
		<li><a href="#form_review" data-toggle="tab" aria-expanded="true">Review</a></li>
<?php if ($page != 'group') { ?>
		<li class="dropdown right pull-right">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<img src="<?php echo $config->me['avatar'] ?>" class="feed-post-user-avt feed-switch-user-avt"/>
				Post as <span class="caret"></span>
			</a>
			<ul class="dropdown-menu feed-switch-user">
		<?php echo '<li role="presentation"><a class="switch-user" role="menuitem" tabindex="-1" href="#" id="'.$config->u.'"><img src="'.$config->me['avatar'].'" class="feed-switch-user-avt"/> '.$config->me['name'].'</a></li>';
			if (count($config->me['myPage']) > 0) echo '<li class="divider"></li>';
			foreach ($config->me['myPage'] as $oP) 
				echo '<li role="presentation"><a class="switch-user" role="menuitem" tabindex="-1" href="#" id="'.$oP['id'].'"><img src="'.$oP['avatar'].'" class="feed-switch-user-avt"/> '.$oP['title'].'</a></li>' ?>
			</ul>
		</li>
<?php } ?>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="form_status">
<form class="bootstrap-validator-form new-post stt-form" action="?do=newstt">
	<img title="<?php echo $config->me['name'] ?>" class="feed-form-avt feed-user-avt" src="<?php echo $config->me['avatar'] ?>">
<!--	<div id="stt-textarea-div" onkeyup="textAreaAdjust(this)" style="overflow:hidden" class="stt-textarea non-sce form-control" contenteditable="true"></div>
	<textarea style="overflow:hidden" name="content" class="hidden stt-textarea non-sce form-control"></textarea> -->
	<textarea style="overflow:hidden" name="content" class="stt-textarea form-control"></textarea>
	<input type="hidden" name="uid" class="feed-post-by"/>
	<div class="clearfix"></div>
	<div class="add-form-submit right">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>
</form>
		</div><!-- /.tab-pane -->
		<div class="tab-pane" id="form_review">
		</div><!-- /.tab-pane -->
	</div><!-- /.tab-content -->
</div>

<?php } ?>
