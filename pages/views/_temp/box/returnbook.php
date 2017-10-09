<form class="bootstrap-validator-forms box-addbook" method="post" action="?do=returnbook" enctype="multipart/form-data">
	<h3 style="margin-bottom:20px">Trả lại sách</h3>
	
	<div class="form-group" style="margin-bottom:7px">
		<div class="col-lg-3 control-label no-padding-left">
			Trả vào box 
		</div>
		<div class="col-lg-9 no-padding">
			<select class="form-control book-select chosen-select" name="box_id">
			<?php foreach ($boxesList as $bO) {
				echo '<option value="'.$bO['id'].'">'.$bO['title'].' ('.$bO['location'].')</option>';
			} ?>
			</select>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="form-group" style="margin-bottom:7px">
		<div class="col-lg-3 control-label no-padding-left">
			Back picture
		</div>
		<div class="col-lg-9 no-padding">
			<input class="form-control" type="file" name="back" id="backIMG" placeholder="Back picture" accept="image/*;capture=camera"/>
			<div class="hide" width="300" height="450" id="cover_picture"></div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="add-form-submit center" style="margin-top:30px">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>
</div>
