<?php
//print_r($_List);

$start = isset($_POST['start']) ? $_POST['start'] : 0;
$records = isset($_POST['records']) ? $_POST['records'] : 24;

$reason = isset($_POST['reason']) ? $_POST['reason'] : null;
$from_uid = isset($_POST['from']) ? $_POST['from'] : null;
$to_uid = isset($_POST['to']) ? $_POST['to'] : null;

$_List = $user->getHistoryAll($from_uid, $to_uid, $reason, $type, $start, $records);
$num = $user->countHistoryAll($from_uid, $to_uid, $reason, $type);
//$num = count($_List);

$pageHTML = '';

if ($num <= 0) {
	$ar[] = '<div class="empty">Không có dữ liệu</div>';
} else {
	$pages = ceil($num/$records)-1;
	$pageHTML = '<ul class="pagination right">';

	$prevSt = $start - $records;
	if ($prevSt <= 0) $pageHTML .= '<li class="paginate_button previous disabled" id="book-list_previous"><a href="#">Previous</a></li>';
	else $pageHTML .= '<li class="paginate_button previous" id="book-list_previous"><a href="?start='.$prevSt.'&records='.$records.'">Previous</a></li>';

	$currentPage = $start/$records;

	if ($pages <= 3) {
		$pageHTML .= $user->showPages(0, $records, $pages, $start);
	} else {
		if ($start <= 1*$records) {
			$pageHTML .= $user->showPages(0, $records, 1, $start);
		} else $pageHTML .= $user->showPages(0, $records, 0, $start);

		if ($start > ($pages-1)*$records) { // page last/last
			$pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
			$pageHTML .= $user->showPages($pages-1, $records, $pages, $start);
		}
		else if ($start > ($pages-2)*$records) { // page (last-1)/last
			$pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
			$pageHTML .= $user->showPages($currentPage-1, $records, $pages, $start);
		}
		else if ($start > ($pages-3)*$records) { // page (last-2)/last
			$pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
			$pageHTML .= $user->showPages($currentPage-1, $records, $pages, $start);
		}
		else {
			if ($start >= 2*$records) {
				if ($start > 2*$records) $pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
				$pageHTML .= $user->showPages($currentPage-1, $records, $currentPage+1, $start);
			} else if ($start > 0) {
				$pageHTML .= $user->showPages(2, $records, 3, $start);
			}
			// last pages
			$pageHTML .= '<li class="paginate_button disabled"><a href="#">...</a></li>';
			$pageHTML .= $user->showPages($pages, $records, $pages, $start);
		}
	}

	$nextSt = $start + $records;
	if ($nextSt > $num) $pageHTML .= '<li class="paginate_button next disabled" id="book-list_next"><a href="#">Next</a></li>';
	else $pageHTML .= '<li class="paginate_button next" id="book-list_next"><a href="?start='.$nextSt.'&records='.$records.'">Next</a></li>';

	$pageHTML .= '</ul>';

	$ar[] = '<div class="one-book-row thead">
			<div class="col-lg-1 one-book-actions">
				Actions
			</div>
			<div class="col-lg-2 one-book-from">
				From
			</div>
			<div class="col-lg-2 one-book-to">
				To
			</div>
			<div class="col-lg-2 one-book-coins">
				Coins
			</div>
			<div class="col-lg-2 one-book-reason">
				Reason
			</div>
			<div class="col-lg-3 one-book-created">
				Time
			</div>
			<div class="clearfix"></div>
		</div>';
foreach ($_List as $bK => $bO) {
	$isUID = ($bO['uid'] > 0 && $bO['type'] == 0) ? 1 : 0;

	if ($bO['from_uid']) $bO['fr_txt'] = '<a title="'.$bO['from']['name'].'" href="'.$bO['from']['link'].'">
		'.$bO['from']['name'].' (@'.$bO['from']['username'].')
	</a>';
	else $bO['fr_txt'] = 'System';

	$ar[] = '<div class="one-book-row" data-id="'.$bO['id'].'">
		<div class="col-lg-1 one-book-actions center">
			<label class="checkbox left">
				<input type="checkbox" value="1" name="bAr"/>
			</label>
			<a class="one-book-delete" href="'.$bO['link'].'?mode=delete&do=delete"><i class="fa fa-times"></i></a>
			<a class="one-book-edit" href="'.$bO['link'].'"><i class="fa fa-cog"></i></a>
		</div>
		<div class="col-lg-2 one-book-from">
			'.$bO['fr_txt'].'
		</div>
		<div class="col-lg-2 one-book-to">
			<a title="'.$bO['to']['name'].'" href="'.$bO['to']['link'].'">
				'.$bO['to']['name'].' (@'.$bO['to']['username'].')
			</a>
		</div>
		<div class="col-lg-2 one-book-coins">
			'.$bO['coins'].'
		</div>
		<div class="col-lg-2 one-book-reason">
			'.$bO['reason'].'
		</div>
		<div class="col-lg-3 one-book-created">
			'.$bO['created'].'
		</div>
		<div class="clearfix"></div>
	</div>';
}
}
echo $pageHTML.'<div class="clearfix"></div>';
echo '<div class="book-list">'.implode('', $ar).'</div>';
echo '<div class="clearfix"></div><div class="left results-show">Hiển thị từ '.($start+1).' đến '.($start+$records).' trong tổng số '.$num.' kết quả</div> '.$pageHTML.'<div class="clearfix"></div>';
 ?>
