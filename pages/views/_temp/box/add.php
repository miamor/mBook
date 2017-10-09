<form class="bootstrap-validator-form box-add" method="post" action="?do=add">
	<h3 style="margin-bottom:20px"><?php echo $page_title ?></h3>

	<div class="form-group" style="margin-bottom:7px">
		<div class="col-lg-3 control-label no-padding-left">
			Tiêu đề 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="text" name="title"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			Location 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="text" name="location"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			<i class="fa fa-map-marker"></i> Place ID 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="text" name="place_id"/>
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
			Thumb <i class="gensmall">(optional)</i>
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="text" name="thumb"/>
		</div>
		<div class="clearfix"></div>
	</div>
	
	<div class="form-group">
		<div class="col-lg-6 no-padding-left">
			<div class="control-label">Rows</div>
			<input class="form-control" type="number" min="0" value="0" name="rows"/>
		</div>
		<div class="col-lg-6 no-padding-right">
			<div class="control-label">Cols</div>
			<input class="form-control" type="number" min="0" value="0" name="cols"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="add-form-submit center" style="margin-top:30px">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>

</form>
