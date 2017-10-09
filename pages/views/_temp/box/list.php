<style>#main-content.page-box{padding:0}</style>
<div class="box-search-book">
<form class="sb-form slide" action="?mode=search">
	<div class="map-canvas no-margin"><div id="map"></div></div>
	<input class="s-input" type="text" name="key" placeholder="Nhập đầu sách tìm kiếm..."/>
</form>

<div class="s-result slide hide" id="result"></div>

</div>

<div class="col-lg-1"></div>
<div class="col-lg-10 no-padding">
<?php if ($config->u && $config->me['is_mod'] === 1) { ?>
	<div class="mode-btns right" style="margin-top:20px">
		<a class="btn btn-default pull-right" href="?mode=add"><span class="fa fa-plus"></span> Thêm box</a>
	</div>
<?php } ?>
	<h2>#bookstop</h2>
	<div class="box-list">
<?php
foreach ($boxesList as $box) { ?>
<div class="one-box col-lg-3">
	<div class="one-box-background" style="background-image:url('<?php echo IMG ?>/bg/tile-bg-<?php echo rand(1,8) ?>.jpg')"></div>
	<div class="one-box-id"><span class="small">#</span><?php echo $box['id'] ?></div>
	<div class="one-box-info">
		<h3 class="one-box-title">
			<a href="<?php echo $box['link'] ?>"><?php echo $box['title'] ?></a>
		</h3>
		<div class="one-box-books-num"><?php echo $box['books_title_num'] ?>/<?php echo $box['books_num'] ?></div>
		<div class="one-box-location"><i class="fa fa-map-marker"></i> <span><?php echo $box['location'] ?></span></div>
	</div>
	<div class="one-box-status" data-stt="<?php echo $box['stt'] ?>"></div>
</div>
<?php } ?>
	</div>
</div>
<div class="col-lg-1"></div>

<div class="clearfix"></div>
