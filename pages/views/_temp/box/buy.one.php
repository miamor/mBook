<?php
echo '<h3>'.$page_title.'</h3>';

$isSent = $box->checkInProgress();

if ($isSent) {
	echo '<div class="alerts alert-info"><div id="load_response"></div>Request has been sent...</b></div>';
}
else echo '<div class="alerts alert-info">
Bạn chắc chắn muốn gửi request <b>mua</b> cuốn sách <b>'.$box->book_title.'</b> chứ? (Yêu cầu này không thể bị hủy)
</div>
<div class="add-form-submits center">
	<div class="btn btn-default" onclick="window.history.back()">Không. Đưa tôi quay lại</div>
	<div class="btn btn-red" id="sure">Chắc chắn</div>
</div>
<div id="loading"></div>';

echo '<div id="response"></div>';
