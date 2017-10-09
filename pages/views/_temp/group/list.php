<form class="col-lg-2 filters no-padding">
	<h3>Lọc kết quả</h3>
	<div class="filter-author-type">
		<h4 class="filter-header with-border">Author type</h4>
		<div class="filter-body">
			<label class="checkbox">
				<input type="checkbox" value="mbook" checked name="auth_type"/> mBook members
			</label>
			<label class="checkbox">
				<input type="checkbox" value="others" checked name="auth_type"/> Others
			</label>

		</div>
	</div>
	<div class="filter-author-type">
		<h4 class="filter-header with-border">Free download</h4>
		<div class="filter-body">
			<label class="radio">
				<input type="radio" value="0" checked name="free_download"/> Everything
			</label>
			<label class="radio">
				<input type="radio" value="1" checked name="free_download"/> With free samples
			</label>

		</div>
	</div>
</form>

<div class="col-lg-10 no-padding-right group-list">
<?php foreach ($_List as $gO) { ?>
	<div class="one-group"><div class="box">
		<div class="box-body no-padding-left no-padding-right">
			<div class="col-lg-2 one-group-thumb no-padding">
				<img class="book-thumb" src="<?php echo $gO['avatar'] ?>"/>
			</div>
			<div class="col-lg-10 no-padding-right">
				<h2 class="one-group-title no-margin-top">
					<a title="<?php echo $gO['title'] ?> - <?php echo $gO['created'] ?>" href="<?php echo $gO['link'] ?>">
						<?php echo $gO['title'] ?>
					</a>
				</h2>
				<div class="one-group-des"><?php echo $gO['des'] ?></div>
			</div>
		</div>
<!--		<div class="box-footer stat feed-sta">
			<div class="feed-status text-info stat-one col-lg-6 no-padding">
				<?php echo $gO['sttText'] ?>
			</div>
			<div class="feed-members text-info stat-one col-lg-6 no-padding text-right">
				<strong><?php echo $gO['memNum'] ?></strong>
				members
			</div>
		</div>-->
	</div></div>
<?php } ?>
	<div class="clearfix"></div>
</div>

<div class="clearfix"></div>
