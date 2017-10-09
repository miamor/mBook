<?php
if (!$temp) echo '<h2>Book box có sách "'.$box->keywordTitle .'" ('.count($response).')</h2>';
if (count($response) <= 0) {
	echo '<div class="italic">Không có kết quả nào.</div>';
} else {
if (!$temp || $temp == 'withjs') echo '<div class="col-lg-7">';
foreach ($response as $k => $one) { ?>
<div class="box-search-one" id="<?php echo $k ?>">
	<img class="box-search-one-thumb" src="<?php echo $one['cover'] ?>"/>
	<div class="box-search-one-details">
		<h4><a href="<?php echo $one['boxInfo']['link'] ?>"><?php echo $one['boxInfo']['title'] ?></a></h4>
		<div>Square id: <?php echo $one['square_id'] ?></div>
		<div>Số lượng còn lại: <?php echo $one['num'] ?></div>
		<div class="box-search-one-route hide">
			<span class="box-search-one-distance"></span>
			 | 
			<span class="box-search-one-time"></span>
		</div>
		<div class="box-search-one-location"><i class="fa fa-map-marker"></i> <?php echo $one['boxInfo']['location'] ?></div>
		<a class="right to-book btn btn-success" href="<?php echo $one['link'] ?>">Đến</a>
	</div>
	<div class="clearfix"></div>
</div>
<?php }
if (!$temp || $temp == 'withjs') { ?>
</div>
<div class="col-lg-5 map-side">
	<div id="floating-panel">
		<input type="hidden" id="start"/>
		<input type="hidden" id="end"/>
	</div>
	<h5>Phương tiện: 
	<select id="travelMode">
		<option value="DRIVING" selected>DRIVING</option>
<!--		<option value="BICYCLING">BICYCLING</option>-->
		<option value="WALKING">WALKING</option>
	</select>
	</h5>
	<div id="warnings-panel"></div>
	<div class="map-canvas no-margin"><div id="map"></div></div>
</div>
<div class="clearfix"></div>
<?php }
} ?>
