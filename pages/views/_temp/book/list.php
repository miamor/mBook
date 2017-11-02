<form id="formFilter" class="col-lg-2 filters no-padding">
	<h3>Lọc kết quả</h3>
	<div class="book-search" id="bsearch">
		<h4 class="filter-header">Tìm theo từ khóa</h4>
		<input class="form-control btit" type="text" id="book-search-title" name="keyword" autocomplete="off" placeholder="Search by title"/>
	</div>
	<div class="filter-genres">
		<h4 class="filter-header">Thể loại</h4>
		<div class="filter-body">
			<select name="genres[]" multiple class="form-control chosen-select">
		<?php foreach ($genList as $gO) {
			echo '<option value="'.$gO['id'].'">'.$gO['title'].'</option>';
		} ?>
			</select>
		</div>
	</div>
	<div class="filter-author">
		<h4 class="filter-header">Tác giả</h4>
		<div class="filter-body">
			<select name="author[]" multiple class="form-control chosen-select">
		<?php foreach ($auList as $aO) {
			echo '<option value="'.$aO['name'].'">'.$aO['name'].'</option>';
		} ?>
			</select>
		</div>
	</div>
	<div class="filter-author">
		<h4 class="filter-header">Sắp xếp</h4>
		<div class="filter-body">
			<div class="col-lg-6 no-padding">
				<select name="order" class="form-control">
					<option value="title">Tên</option>
					<option value="modified" selected>Thời gian</option>
				</select>
			</div>
			<div class="col-lg-6 no-padding">
				<select name="order_sort" class="form-control">
					<option value="asc" selected>Tăng dần</option>
					<option value="desc" selected>Giảm dần</option>
				</select>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<!--	<div class="filter-free-download">
		<h4 class="filter-header">Free download</h4>
		<div class="filter-body">
			<label class="radio">
				<input type="radio" value="0" checked name="free_download"/> Everything
			</label>
			<label class="radio">
				<input type="radio" value="1" name="free_download"/> With free samples
			</label>
		</div>
	</div>
	<div class="filter-status">
		<h4 class="filter-header">Tình trạng</h4>
		<div class="filter-body">
			<label class="radio">
				<input type="radio" value="1" name="status"/> Đã hoàn thành
			</label>
			<label class="radio">
				<input type="radio" value="-1" checked name="status"/> Tất cả
			</label>
		</div>
	</div>-->
	<div class="filter-status">
		<h4 class="filter-header">Tình trạng</h4>
		<div class="filter-body">
			<label class="radio">
				<input type="radio" value="1" name="in_storage"/> Có trong kho sách
			</label>
			<label class="radio">
				<input type="radio" value="-1" checked name="in_storage"/> Tất cả
			</label>
		</div>
	</div>

	<div class="center">
		<input type="submit" value="Lọc"/>
	</div>
</form>

<div class="col-lg-10 no-padding-right">
	<form class="book-search col-lg-4 no-padding" id="bSearch">
		<div class="col-lg-6">
			<select class="form-control records" type="text" id="records-per-page" name="records">
				<option selected value="24">24</option>
				<option value="48">48</option>
				<option value="120">120</option>
				<option value="216">216</option>
			</select>
		</div>
	</form>
	<div id="book-list"></div>
</div>

<div class="clearfix"></div>
