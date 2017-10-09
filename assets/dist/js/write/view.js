$(document).ready(function () {
	var chapters = $('table#books_chapters').DataTable({
		"ordering": false,
//		"order": [[1, 'asc']],
		"pageLength": 5,
		"lengthMenu": [5, 15, 50, 100]
	});
	if ($('table#books_publisher').length) {
		var publishers = $('table#books_publisher').DataTable({
			"order": [[2, 'desc']]
		});
	} else if ($('table#books_request_publish').length) {
		var requests = $('table#books_request_publish').DataTable({
			"order": [[0, 'asc']]
		});
	}
	$('.book-des .box-body').each(function () {
		var lines = $(this).html().split(/\<br\>|\<br\/\>|\<br\>\<br\/\>/);
		$(this).html('<p>' + lines.join("</p><p>") + '</p>');
	});
	$('.book-des p').each(function () {
		if ($(this).html() == '&nbsp;') $(this).remove();
	});
	// report link
	$('.report-link a').click(function () {
		popup_page($(this).attr('href'));
		return false
	})
})
