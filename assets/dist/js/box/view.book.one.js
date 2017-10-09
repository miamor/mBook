function loadMore () {
	var bookLink = $('input.bookLink').val();
/*	var url = MAIN_URL+'/book/'+bookLink+'/reviews?temp=search';
	$.get(url, function (data) {
		$('#rv_local').html(data);
	});
*/	$('#rv_local').load(MAIN_URL+'/book/'+bookLink+' .book-info>.col-lg-3', function () {
		$(this).children('.col-lg-3').removeClass('col-lg-3');
	});
	$('.s-buy').load(MAIN_URL+'/book/'+bookLink+' .book-advanced');
	$.get(MAIN_URL+'/box?mode=search&key='+bookLink+'&temp=true', function (data) {
		$('.more-boxes').prepend('<h3>Các box khác</h3>');
		$('.other_boxes').html(data);
	})
}

function loadBookInfo () {
	$('#book_data').html(loading);
	$.get(window.location.href+'&mode=getBookData&temp=true', function (data) {
		$('#book_data').html(data);
		$('#book_rate_data').html($('#book_data .book_rate_data').html());
		$('#book_data .book_rate_data').remove();
		loadMore();
		$('.book-des .box-body').each(function () {
			var lines = $(this).html().split(/\<br\>|\<br\/\>|\<br\>\<br\/\>/);
			$(this).html('<p>' + lines.join("</p><p>") + '</p>');
		});
		$('.book-des p').each(function () {
			if ($(this).html() == '&nbsp;') $(this).remove();
		});
	});
}

$(document).ready(function () {
	loadBookInfo();
})
