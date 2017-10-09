<div class="col-lg-2"></div>
<form class="bootstrap-validator-form new-write col-lg-8 no-padding" action="?do=edit">
	<h3 class="no-margin-top">Sửa bài viết - <?php echo $title ?></h3>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Tiêu đề</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" name="title" value="<?php echo $title ?>" type="text"/>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Thể loại</div>
		<div class="col-lg-9 no-padding">
			<select name="genres[]" multiple class="form-control chosen-select">
		<?php foreach ($genList as $gO) {
			$selected = '';
			if (in_array($gO, $genres)) $selected = 'selected';
			echo '<option '.$selected.' value="'.$gO['id'].'">'.$gO['title'].'</option>';
		} ?>
			</select>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Cover</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" name="cover" placeholder="Book cover" value="<?php echo $thumb ?>" type="text"/>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3 control-label no-padding-left">Lời dẫn</div>
		<div class="col-lg-9 no-padding">
			<textarea class="form-control" name="des"><?php echo $des ?></textarea>
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