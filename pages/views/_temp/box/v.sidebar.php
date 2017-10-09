<?php if ($config->u && $config->me['is_mod'] === 1) { ?>
	<div class="dropdown box-manage right pull-right">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li role="presentation"><a role="menuitem" tabindex="-1" href="?mode=edit"><i class="fa fa-edit"></i> Sửa box</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="?mode=addbook"><i class="fa fa-book"></i> Thêm sách</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="?mode=editbooks"><i class="fa fa-list"></i> Sửa sách</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="?do=lock" id="box_lock">
				<?php echo ($box->stt) ? '<i class="fa fa-lock"></i> Khóa box' : '<i class="fa fa-unlock"></i> Mở khóa box' ?>
			</a></li>
			<li role="presentation" class="divider"></li>
			<li role="presentation"><a role="menuitem" class="text-danger" tabindex="-1" href="?do=delete" id="box_del">Xóa box này</a></li>
		</ul>
	</div>
<?php } ?>
	<h2 class="box-title" title="<?php echo $title ?>">
		<a href="<?php echo $link ?>"><?php echo $title ?></a>
		<?php echo '<span class="box-stt" data-stt="'.$box->stt.'"></span>' ?>
		<div class="clearfix"></div>
	</h2>

	<div class="one-box-books-num"><?php echo $books_title_num ?>/<?php echo $books_num ?></div>
	<div class="one-box-location"><i class="fa fa-map-marker"></i> <span><?php echo $location ?></span></div>

<?php if (!$mode) echo '<div class="divider"></div>
<input type="hidden" id="start"/>
<input type="hidden" id="end" value="'.$location.'"/>
<div class="travel-mode left">
	<span style="font-size:13px">Phương tiện: </span>
	<select id="travelMode">
		<option value="DRIVING" selected>DRIVING</option>
		<option value="BICYCLING">BICYCLING</option>
		<option value="WALKING">WALKING</option>
	</select>
</div>
<div class="btn btn-red right get-direction">Get direction</div>
<div class="clearfix"></div>
<div>
	<a href="#" class="bigger-map left" title="Mở rộng"><i class="fa fa-arrows-alt"></i></a>
	<div class="box-search-one-route hide right">
		<span class="box-search-one-distance"></span>
			 | 
		<span class="box-search-one-time"></span>
	</div>
</div>
<div class="clearfix"></div>
<div class="map-canvas box-sidebar" style="margin:10px 0"><div id="map"></div></div>
<div id="warnings-panel"></div>
<script>var PLACE_ID = "'.$place_id.'";
var BOX_TITLE = "'.$title.'"</script>' ?>
