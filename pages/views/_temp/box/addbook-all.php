<form class="bootstrap-validator-forms box-addbook" method="post" action="?do=addbook" enctype="multipart/form-data">
	<h3 style="margin-bottom:20px"><?php echo $page_title ?></h3>

	<div class="form-group" style="margin-bottom:7px">
		<div class="col-lg-3 control-label no-padding-left">
			Tiêu đề 
		</div>
		<div class="col-lg-9 no-padding">
			<select class="form-control book-select chosen-select" name="bid">
				<option value="0" selected>--- Chọn từ danh sách có trong mBook ---</option>
				<optgroup label="Đã được kiểm duyệt">
			<?php foreach ($allBooks as $bO) {
				echo '<option value="'.$bO['id'].'">'.$bO['title'].'</option>';
			} ?>
				</optgroup>
			</select>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
		</div>
		<div class="col-lg-6 no-padding">
			<input class="form-control" type="text" name="title"/>
		</div>
		<div class="col-lg-3 no-padding-right">
			<input class="form-control" type="text" readonly name="barcode" placeholder="Barcode" id="barcode">
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			Số lượng 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="number" min="0" value="0" name="num"/>
		</div>
		<div class="clearfix"></div>
	</div>
	
	<div class="divider"></div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			Box
		</div>
		<div class="col-lg-5 no-padding">
			<select class="form-control chosen-select" name="box[]">
		<?php foreach ($boxesList as $bO) {
				echo '<option value="'.$bO['id'].'">#'.$bO['id'].': '.$bO['title'].'</option>';
			} ?>
			</select>
		</div>
		<div class="col-lg-4 no-padding-right">
			<input class="form-control" type="number" min="0" name="square[]" placeholder="Square ID (ở ô số)"/>
		</div>
		<div class="clearfix"></div>
	</div>
	<a href="#" class="add-box"><i class="fa fa-plus"></i> Thêm đầu sách này vào box</a>
	<div class="divider"></div>

	<div class="form-group">
		<div class="col-lg-6 no-padding-left">
			<div style="margin-bottom:4px">Giá mua </div>
			<input class="form-control" type="number" value="0" min="0" name="price"/>
		</div>
		<div class="col-lg-6 no-padding-left">
			<div style="margin-bottom:4px">Giá mượn </div>
			<input class="form-control" type="number" value="0" min="0" name="price_rent"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="divider"></div>

	<div class="form-group">
		<div class="col-lg-6 no-padding-left">
			<div style="margin-bottom:8px">Ảnh mặt trước </div>
			<input class="form-control" type="file" name="cover" id="coverIMG" placeholder="Book cover" accept="image/*;capture=camera"/>
			<div class="hide" width="300" height="450" id="cover_picture"></div>
		</div>
		<div class="col-lg-6 no-padding-left">
			<div style="margin-bottom:8px">Ảnh mặt sau </div>
			<input class="form-control" type="file" name="back" id="getBarcode" placeholder="Book back" accept="image/*;capture=camera"/>
			<canvas class="hide" width="300" height="450" id="back_picture"></canvas>
			<div id="textbit" class="hidden"></div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="add-form-submit center" style="margin-top:30px">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>

</form>
