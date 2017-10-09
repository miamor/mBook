<form class="small bootstrap-validator-form search-cover" method="post" action="?do=search_cover" enctype="multipart/form-data">
	<input class="form-control" type="file" name="cover" id="coverIMG" placeholder="Book cover" accept="image/*;capture=camera">
	<div class="hide" width="300" height="450" id="cover_picture"></div>
	<input type="submit" value="Search"/>
</form>

<form class="s-form small" action="?do=search" style="*background-image:url('<?php echo MAIN_URL.'/assets/dist/img/bg/'.rand(1,14).'.jpg' ?>')">
	<div class="col-lg-2 no-padding">
		<input class="form-control" type="file" name="img" id="find_image" placeholder="Search by image" accept="image/*;capture=camera">
	</div>
	<div class="col-lg-6 no-padding">
		<input class="s-input" type="text" name="key" placeholder="Book title, ISBN,..."/>
<!--		<div class="s-advanced form-group">
			<div class="col-lg-6">
				<label class="checkbox">
					<input type="checkbox" value="1" checked name="auth_type"/> Chủ đề
				</label>
			</div>
			<div class="col-lg-6">
				<label class="checkbox">
					<input type="checkbox" value="0" checked name="auth_type"/> Truyện/tác phẩm
				</label>
			</div>
			<div class="clearfix"></div>
		</div> -->
	</div>
	<div class="col-lg-2">
		<input type="submit" value="Search"/>
	</div>
	<div class="clearfix"></div>
	<div class="">
		<canvas class="hide" width="300" height="450" id="img_to_search"></canvas>
		<div id="textbit" class="hidden"></div>
	</div>
</form>

<div class="s-result slide hide" id="result"></div>
