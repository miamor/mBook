<h2>Transfering history</h2>

<form id="formFilter" class="filterBox filters">
	<h3 class="filterBox-header">Filter</h3>

	<div class="book-search form-group">
		<div class="col-lg-4 control-label text-right">From</div>
		<div class="col-lg-6">
			<select name="from[]" multiple class="form-control chosen-select">
				<option value="0">System</option>
		<?php foreach ($uList as $aO) {
			echo '<option value="'.$aO['id'].'">'.$aO['name'].'</option>';
		} ?>
			</select>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="book-search form-group">
		<div class="col-lg-4 control-label text-right">To</div>
		<div class="col-lg-6">
			<select name="to[]" multiple class="form-control chosen-select">
		<?php foreach ($uList as $aO) {
			echo '<option value="'.$aO['id'].'">'.$aO['name'].'</option>';
		} ?>
			</select>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="book-search form-group">
		<div class="col-lg-4 control-label text-right">Reason</div>
		<div class="col-lg-6">
			<input class="form-control" type="text" name="reason"/>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="filter-status form-group">
		<div class="col-lg-4 text-right">Type</div>
		<div class="col-lg-6">
			<label class="radio col-lg-3">
				<input type="radio" value="1" name="type"/> Add
			</label>
			<label class="radio col-lg-3">
				<input type="radio" value="-1" name="type"/> Substract
			</label>
			<label class="radio col-lg-3">
				<input type="radio" value="0" checked name="type"/> All
			</label>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="center">
		<input type="submit" value="Lọc"/>
	</div>
</form>

<div class="">
	<div id="book-list"></div>
</div>

<div class="clearfix"></div>
