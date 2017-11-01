function newReview () {
	$('.feed-rv-book').show();
	rate(".new-review");
	$('#notfindbook').click(function () {
		$('.book-select').attr('disabled', true).trigger('chosen:updated');
		$('.book-name').show();
		$(".feed-rv-book").html("Xem trước sách không khả dụng");
		return false
	});
	$('.book-select').on('chosen:ready', function () {
		$('.chosen-container').attr('style', 'width:100%').on('click', function () {
			$('.book-name').hide();
			$('.book-select').attr('disabled', false).trigger('chosen:updated');
			return false
		});
	});

	$('.book-select').on('change', function () {
		$('input[name="book"]').val($('select.book-select option:selected').text());
		var id = $(this).val();
		$.get(MAIN_URL+"/review?do=bIn&bid="+id, function (data) {
			$(".feed-rv-book").html(data);
		});
	})
}

$(document).ready(function () {
	newReview();
})
