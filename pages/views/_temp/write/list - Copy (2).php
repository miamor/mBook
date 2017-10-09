<form id="formFilter" class="col-lg-2 filters no-padding">
	<h3>Lọc kết quả</h3>
	<div class="filter-author-type">
		<h4 class="filter-header with-border">Kiểu</h4>
		<div class="filter-body">
			<label class="checkbox">
				<input type="checkbox" value="1" checked name="auth_type"/> Chủ đề
			</label>
			<label class="checkbox">
				<input type="checkbox" value="0" checked name="auth_type"/> Truyện/tác phẩm
			</label>

		</div>
	</div>
	<div class="filter-status">
		<h4 class="filter-header with-border">Tình trạng</h4>
		<div class="filter-body">
			<label class="radio">
				<input type="radio" value="1" checked name="status"/> Đã hoàn thành
			</label>
			<label class="radio">
				<input type="radio" value="-1" checked name="status"/> Tất cả
			</label>
		</div>
	</div>
</form>

<div class="col-lg-10 no-padding-right">
<div class="mode-btns right">
	<a class="btn btn-default pull-right" href="?mode=new"><span class="fa fa-plus"></span> Chủ đề mới</a>
</div>
<h2 class="no-margin-top">Bài viết bởi thành viên</h2>
<table id="book-list" class="book-list">
<thead class="hidden">
	<tr>
		<th class="hidden th-none"></th>
		<th class="hidden th-none"></th>
	</tr>
</thead>
<tbody>
<?php 
$totalW = 0;
foreach ($_List as $bk => $bO) {
	if ($bO['type'] == 1) {
		echo '<tr class="col-lg-6"><td class="box one-book" data-topic="1">';
		include 'l.topic.php';
	} else {
	echo '<tr class="col-lg-6"><td class="box one-book" data-published="'.$bO['published'].'" data-authenticated="'.$bO['authenticated'].'">';
		include 'l.book.php';
	}
	echo '</td></tr>';
} ?>
</tbody>
</table>
</div>

<div class="clearfix"></div>
