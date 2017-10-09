<form class="col-lg-2 filters no-padding">
	<h3>Lọc kết quả</h3>
	<div class="filter-author-type">
		<h4 class="filter-header with-border">Author type</h4>
		<div class="filter-body">
			<label class="checkbox">
				<input type="checkbox" value="mbook" checked name="auth_type"/> mBook members
			</label>
			<label class="checkbox">
				<input type="checkbox" value="others" checked name="auth_type"/> Others
			</label>

		</div>
	</div>
	<div class="filter-author-type">
		<h4 class="filter-header with-border">Free download</h4>
		<div class="filter-body">
			<label class="radio">
				<input type="radio" value="0" checked name="free_download"/> Everything
			</label>
			<label class="radio">
				<input type="radio" value="1" checked name="free_download"/> With free samples
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
		$w[$bk] = 3;
		$totalW += $w[$bk];
		echo '<tr class="col-lg-3 no-padding-left"><td class="box one-book" data-topic="1">';
		include 'l.topic.php';
	} else {
/*		if ($bk == 0 && ($_List[$bk+1]['type'] + $_List[$bk+2]['type'] == 1)) $w[$bk] = 9;
		else if (($_List[$bk-1]['type'] + $_List[$bk+1]['type'] == 1) && $w[$bk-2] != 9) $w[$bk] = 9;
		else $w[$bk] = 6;
		
		if ($bk > 0 && $bk%3 == 0) {
			if (($w[$bk-2]+$w[$bk-1]+$w[$bk-3])==12) {
				if ($_List[$bk+1]['type'] == 1) $w[$bk] = 9;
				else $w[$bk] = 6;
			}
		}
		
		if ($bk > 0 && $bk%4 == 0) {
			
		}
*/		


/*		if ($bk%2 == 0) {
			if ($_List[$bk+1]['type'] == 1) $w[$bk] = 9;
			else $w[$bk] = 6;
		} else {
			if ($_List[$bk-1]['type'] == 1) $w[$bk] = 9;
			else $w[$bk] = 6;
		}

		if ($bk%3 == 2) {
			if (($w[$bk-2]+$w[$bk-1])==6) $w[$bk] = 6;
		}
*/		

		$w[$bk] = 6;

		if ($bk == 0) {
			if ($_List[$bk+1]['type'] + $_List[$bk+2]['type'] == 6) $w[$bk] = 6;
			else $w[$bk] = 9;
		}

		if ($totalW%12 == 0) {
			if (($_List[$bk+1]['type'] + $_List[$bk+2]['type']) == 2) $w[$bk] = 6; // both next are topic
			else {
				if ($_List[$bk+1]['type'] == 1) $w[$bk] = 9; // next one is topic
				else if ($_List[$bk+2]['type'] == 1) $w[$bk] = 6; // next one is topic
			}
		} else if ($totalW%12 == 3) {
			if ($_List[$bk+1]['type'] == 1) $w[$bk] = 6; // next one is topic
			else $w[$bk] = 9;
		} else if ($totalW%12 == 6) {
			$w[$bk] = 6;
		}
		
		$totalW += $w[$bk];

		echo '<tr class="col-lg-'.$w[$bk].' no-padding-left"><td class="box one-book" data-published="'.$bO['published'].'" data-authenticated="'.$bO['authenticated'].'">';
		include 'l.book.php';
	}
	echo '</td></tr>';
} ?>
</tbody>
</table>
</div>

<div class="clearfix"></div>
