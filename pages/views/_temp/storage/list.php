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

<div class="col-lg-10 no-padding-right book-list">
	<h2 class="no-margin">Danh sách sách trong kho lưu trữ</h2>
<?php foreach ($lettersAr as $oneLetter) { ?>
	<div class="letter letter-<?php echo $oneLetter ?>">
		<div class="the-letter"><?php echo strtoupper($oneLetter) ?></div>
		<div class="letter-books">
	<?php foreach ($_List[$oneLetter] as $bO) { ?>
			<div class="one-book-storage col-lg-2 no-padding-left">
				<a class="one-book-storage-thumb" href="<?php echo $bO['link'] ?>">
					<img class="book-thumb" src="<?php echo $bO['thumb'] ?>"/>
				</a>
				<a class="one-book-storage-title" href="<?php echo $bO['link'] ?>">
					<?php echo $bO['title'] ?>
				</a>
			</div>
	<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
<?php } ?>
	<div class="clearfix"></div>
</div>

<div class="clearfix"></div>
