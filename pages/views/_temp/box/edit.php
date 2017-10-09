<form class="bootstrap-validator-form box-edit" method="post" action="?do=edit">
	<h3 style="margin-bottom:20px"><?php echo $page_title ?></h3>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			Tên box 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="text" name="title" value="<?php echo $box->title ?>" placeholder="Title"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			Địa điểm 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="text" name="location" value="<?php echo $box->location ?>" placeholder="Location"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			<i class="fa fa-map-marker"></i> Place ID 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="text" name="place_id" value="<?php echo $box->place_id ?>"/>
		</div>
		<div class="clearfix"></div>
		
		<div class="map-canvas">
			<input id="pac-input" class="controls" type="text"
				placeholder="Enter a location">
			<div id="map"></div>
			<div id="infowindow-content">
			  <span id="place-name"  class="title"></span><br>
			  Place ID <span id="place-id"></span><br>
			  <span id="place-address"></span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			Thumbnail 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="text" name="thumb" value="<?php echo $box->thumb ?>" placeholder="Thumbnail"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="add-form-submit center" style="margin-top:30px">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>

</form>
