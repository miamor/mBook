<form method="post" class="new-print col-lg-8 no-padding" action="?do=add" enctype="multipart/form-data">
	<h3 class="no-margin-top">Bài viết mới</h3>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Tiêu đề</div>
		<div class="col-lg-7 no-padding">
			<input class="form-control" name="title" type="text">
		</div>
		<div class="col-lg-2 no-padding-right">
			<input class="form-control" name="edition" type="number" placeholder="Edition">
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Front</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" name="cover" placeholder="Book cover" type="file" accept="image/*;capture=camera">
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Back</div>
		<div class="col-lg-6 no-padding">
			<input class="form-control" name="back" placeholder="Back" type="file" id="getBarcode" accept="image/*;capture=camera">
		</div>
		<div class="col-lg-3 no-padding-right">
			<input class="form-control" type="text" readonly name="barcode" placeholder="Barcode" id="barcode"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="add-form-submit center">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>
</form>

<div class="col-lg-4 no-padding-right">
	<canvas width="320" height="240" id="picture"></canvas>
	<p id="textbit"></p>
</div>