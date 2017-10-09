<form class="bootstrap-validator-form box-addbook" method="post" action="?b=<?php echo $box->book_id ?>&do=editonebook" enctype="multipart/form-data">
	<h3 style="margin-bottom:20px"><?php echo $page_title ?></h3>

<div class="col-lg-9 no-padding">
	<div class="form-group" style="margin-bottom:7px">
		<div class="col-lg-3 control-label no-padding-left">
			Tiêu đề
		</div>
		<div class="col-lg-9 no-padding">
			<select class="form-control book-select chosen-select" name="bid">
				<option value="0">--- Chọn từ danh sách có trong mBook ---</option>
				<optgroup label="Đã được kiểm duyệt">
			<?php foreach ($allBooks as $bO) {
				if ($box->book_bid == $bO['id']) echo '<option selected value="'.$bO['id'].'">'.$bO['title'].'</option>';
				else echo '<option value="'.$bO['id'].'">'.$bO['title'].'</option>';
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
			<input class="form-control" type="text" name="title" placeholder="Tên sách" value="<?php echo $box->book_title ?>"/>
		</div>
		<div class="col-lg-3 no-padding-right">
			<input class="form-control" type="text" readonly name="barcode" placeholder="Barcode" value="<?php echo $box->book_barcode ?>" id="barcode">
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			Số lượng 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="number" name="num" min="0" value="<?php echo $box->book_num ?>"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">
			Square ID (ở ô số) 
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="number" min="0" value="<?php echo $box->book_square_id ?>" name="square"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-6 no-padding-left">
			<div style="margin-bottom:4px">Giá mua </div>
			<input class="form-control" type="number" name="price" min="0" value="<?php echo $box->book_price ?>"/>
		</div>
		<div class="col-lg-6 no-padding-left">
			<div style="margin-bottom:4px">Giá mượn </div>
			<input class="form-control" type="number" name="price_rent" min="0" value="<?php echo $box->book_price_rent ?>"/>
		</div>
		<div class="clearfix"></div>
	</div>

</div>

	<div class="col-lg-3 no-padding-right">
		<div class="box-squares-thumb">
		<?php for ($i = 1; $i <= $boxView['squares']; $i++) {
			if ($box->book_square_id == $i) $cls = ' active';
			else $cls = ''; 
			echo '<div class="box-one-square'.$cls.'" style="width:'.$boxView['widthPerSquare'].'%"><div class="box-square-one-id">'.$i.'</div></div>';
			if ($i%$boxView['cols'] == 0) echo '<div class="clearfix"></div>';
		} ?>
		<?php for ($i = 0; $i < $boxView['rows']; $i++) { ?>
		<?php } ?>
		</div>
	</div>
<div class="clearfix"></div>

	<div class="form-group">
		<div class="col-lg-6 no-padding-left">
			<div style="margin-bottom:8px">Ảnh mặt trước </div>
			<input class="form-control" type="file" name="cover" id="coverIMG" placeholder="Book cover" accept="image/*;capture=camera"/>
			<div width="300" height="450" id="cover_picture">
				<img id="cover_image" class="thumb-image" width="300" height="450" src="<?php echo $box->book_coverIMG ?>"/>
			</div>
		</div>
		<div class="col-lg-6 no-padding-left">
			<div style="margin-bottom:8px">Ảnh mặt sau </div>
			<input class="form-control" type="file" name="back" id="getBarcode" placeholder="Book back" accept="image/*;capture=camera"/>
			<canvas class="hide" width="300" height="450" id="back_picture"></canvas>
			<div id="textbit" class="hidden"></div>
			<img id="back_image" class="hidden" src="<?php echo $box->book_backIMG ?>"/>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="add-form-submit center" style="margin-top:30px">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>

</form>
