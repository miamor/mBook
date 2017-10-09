var url = window.location.href.split('&')[0];
var intervalLoadResponse = null;
var intervalLoadHandle = null;

var loadResponse = function () {
	$.get(url+'&do=get_response', function (data) {
//		console.log(url+'&do=get_response');
		console.log('Get response: '+data);
		if (data != -1) {
			clearInterval(intervalLoadResponse);
			$('.alerts,.add-form-submits').remove();
			$('#response').html('<div class="alerts alert-success">Quá trình hoàn tất! Vui lòng nhận sách của bạn ở cửa box.</div>');
		}
/*		else if (data != -1) { // không cần cái này
			$('#response').html('<div class="alerts alert-info">Request ô '+data+' đang được xử lý. Vui lòng đợi.</div>');
		}
*/	});
};

var loadHandle = function () {
	$.get(url+'&do=buy_handle', function (data) {
		console.log('Buy handle: '+data);
		if (data == 2) {
			clearInterval(intervalLoadHandle);
			$('.alerts,.add-form-submits').remove();
			$('#response').html('<div class="alerts alert-success">Quá trình đã hoàn tất.</div>');
		}
		else if (data == 1) {
			clearInterval(intervalLoadHandle);
			$('.alerts,.add-form-submits').remove();
			$('#response').html('<div class="alerts alert-info">Request đã được nhận. Đang được thực thi...</div>');
			intervalLoadResponse = setInterval(loadResponse, 1000); // Load status
		}
		else if (data == -1) {
			clearInterval(intervalLoadHandle);
			$('.alerts,.add-form-submits').remove();
			$('#response').html('<div class="alerts alert-error">Request đã được nhận. Có lỗi khi thực thi request.</div>');
		}
		else if (data == 0) {
//			clearInterval(intervalLoadHandle);
			$('.alerts,.add-form-submits').remove();
			$('#response').html('<div class="alerts alert-info">Request đang trong hàng đợi...</div>');
		} 
	});
};

$(document).ready(function () {
	if ($('#sure').length) {
		$('#sure').click(function () {
			$.get(url+'&do=buy', function (data) {
				console.log('Buy: '+data);
				if (data == -2) {
					$('#loading').html('<div class="alerts alert-error">Không tìm thấy đầu sách hoặc số lượng sách không đủ.</div>');
				}
				else if (data == -1) {
					$('#loading').html('<div class="alerts alert-warning">Có lỗi trong quá trình gửi request lên cơ sở dữ liệu. Vui lòng liên hệ administrator để biết thêm chi tiết.</div>');
				}
				else if (data == 1) {
					$('#loading').html('<div class="alerts alert-info"><div id="load_response"></div>Gửi request thành công. Đang xử lý request... </div>');
					intervalLoadHandle = setInterval(loadHandle, 1000);
				}
/*				else if (data == -1) {
					$('#loading').html('<div class="alerts alert-error">Có lỗi trong quá trình gửi request lên cơ sở dữ liệu. Vui lòng liên hệ administrator để biết thêm chi tiết.</div>');
				}
				else {
					if (data == 0) {
						$('#loading').html('<div class="alerts alert-warning"><div id="load_response"></div>Đang có request khác chờ được thực hiện. Bạn vui lòng thử lại sau.</div>');
					}
					else if (data == 1) {
						$('#loading').html('<div class="alerts alert-info"><div id="load_response"></div>Đang gửi request... </div>');
					}
					intervalLoadResponse = setInterval(loadResponse, 1000);
				} */
			})
		})
	} else {
		intervalLoadHandle = setInterval(loadHandle, 1000);
	}
});
