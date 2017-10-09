function crawl (author) {
	$.ajax({
		type: "GET",
//		url: "http://en.wikipedia.org/w/api.php?action=parse&format=json&prop=text&section=0&page=Jimi_Hendrix&callback=?",
		url: "http://vi.wikipedia.org/w/api.php?action=parse&format=json&prop=text&page="+author+"&callback=?",
		contentType: "application/json; charset=utf-8",
		async: false,
		dataType: "json",
		success: function (data, textStatus, jqXHR) {
//			console.log(data);
//			console.log(textStatus);
//			console.log(jqXHR);
			if (!data.error) {
				var markup = data.parse.text["*"];
				var blurb = $('<div></div>').html(markup);
	 
				// remove links as they will not work
				blurb.find('a').each(function() { 
					$(this).replaceWith($(this).html()); 
				});
	 
				// remove any references
				blurb.find('sup').remove();
	 
				// remove cite error
				blurb.find('.mw-ext-cite-error').remove();
				var content = '';
				$(blurb).find('p').each(function () {
					content += '<p>'+$(this).html()+'</p>';
				})
				$('.result[data-author="'+author+'"]').html(content);
				// send this content to post page, to update author info
			} else content = '.';
			console.log(content);
			addAuthor(author, content);
		},
		error: function (errorMessage) {
		}
	});
}

function addAuthor (author, content) {
	$.ajax({
		url: '?temp=addAuthor',
		type: 'post',
		data: 'author='+author+'&content='+content,
		success: function (data) {
			console.log(data);
		}
	})
}


$(document).ready(function () {
//	var search = encodeURIComponent(window.location.href.split(/author=|&/)[1]);
//	var search = window.location.href.split(/author=|&/)[1];
//	console.log(window.location.href);
	$('.result').each(function () {
		var author = $(this).attr('data-author');
		crawl(author)
	})
});
