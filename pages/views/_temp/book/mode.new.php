<div class="col-lg-2"></div>
<form class="bootstrap-validator-form new-write col-lg-8 no-padding" action="?do=new">
	<h3 class="no-margin-top">Thêm sách mới</h3>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Tiêu đề *</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" name="title" type="text"/>
		</div>
		<div class="clearfix"></div>
	</div>
<?php //if ($config->me['is_mod'] === 1) { ?>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Tác giả *</div>
		<div class="col-lg-5 no-padding">
			<select name="author" class="form-control chosen-select">
				<option value="0">Select an author</option>
		<?php foreach ($auList as $aO) {
			echo '<option value="'.$aO['name'].'">'.$aO['name'].'</option>';
		} ?>
			</select>
		</div>
		<div class="col-lg-4 no-padding-right">
			<input class="form-control" name="author_text" type="text" placeholder="Or input an author name"/>
		</div>
		<div class="clearfix"></div>
	</div>
<?php //} ?>

	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Thể loại *</div>
		<div class="col-lg-9 no-padding">
			<select name="genres[]" multiple class="form-control chosen-select">
		<?php foreach ($genList as $gO) {
			echo '<option value="'.$gO['id'].'">'.$gO['title'].'</option>';
		} ?>
			</select>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Cover *</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" name="cover" placeholder="Book cover" type="text"/>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Lời dẫn *</div>
		<div class="col-lg-9 no-padding">
			<textarea class="form-control" name="des"></textarea>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Link download ebook </div>
		<div class="col-lg-9 no-padding">
			<textarea class="form-control non-sce" name="download"></textarea>
			<div class="small">(*) Nếu có nhiều hơn 1 link, đặt mỗi link một dòng.</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-lg-3 no-padding-left">Published</div>
		<div class="col-lg-9 no-padding">
			<label class="radio col-lg-3">
				<input type="radio" value="1" checked name="published"/> Yes
			</label>
			<label class="radio col-lg-3">
				<input type="radio" value="0" name="published"/> No
			</label>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="add-form-submit center">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>
</form>
<div class="col-lg-2"></div>
<div class="clearfix"></div>
