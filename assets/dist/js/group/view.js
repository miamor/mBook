/*var table = $('table#post-list').DataTable({
	"ajax": '?do=getComments',
	"ordering": false,
//	"order": [[0, 'asc']], // order by time asc
	"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		$(nRow).attr("id", aData[1]);
		return nRow;
	},
	"aoColumns": [
		{ "sClass": "hidden" },
		{ "sClass": "hidden" },
		{ "sClass": "one-comt", "sValign": "top" }
	],
	"initComplete": function (settings, json) {
//		console.log(json.data);
		if (json.data.length > 0) {
			$('.r-cmts').show();
			var p = window.location.href.split('#')[1];
			if (p) {
				table.row(Number(p)-1).scrollTo(false);
			}
			setInterval(function () {
				table.ajax.reload(function (json) {
					// do something?
				}, false);
			}, 100000);
		} else $('.r-cmts').hide();
	}
});*/

function likeFeed ($element) {
	if ($element.find('.post-like').length) {
		$element.find('.post-like').click(function () {
			$this = $(this);
			$llist = $this.closest('.feed-content').find('.show-likes-list');
			$.post(MAIN_URL+'/status/'+$this.attr('id')+'?do=like', function (data) {
				if (data == 1) {
					if ($this.is('.liked')) {
						$this.removeClass('liked');
						$this.find('strong').text(Number($this.find('strong').text()) - 1);
						$llist.find('.your-like').remove();
						if ($llist.text() == ' thích bài viết này') $llist.closest('.box-likes-show').hide();
					} else {
						$this.addClass('liked');
						$this.find('strong').text(Number($this.find('strong').text()) + 1);
						$llist.closest('.box-likes-show').show();
						if ($llist.text().indexOf('và') > -1) $llist.prepend('<span class="your-like">Bạn, </span>');
						else if ($llist.text() != ' thích bài viết này') $llist.prepend('<span class="your-like">Bạn và </span>');
						else $llist.prepend('<span class="your-like">Bạn</span>');
					}
				} else mtip('', 'error', '', 'Oops! Something went wrong!');
			})
			return false
		})
	}
}

function loadFeed (href, $feed, id, type) {
	$.ajax({
		url: href,
		type: 'get',
		success: function (data) {
			$feed.html(data);
			$fContent = $feed.find('.feed-main-content');
			
			regex = /\W(\#[a-zA-Z]+\b)(?!;)/gm;
			$fContent.html($fContent.html().replace(/(^|\W)(#[a-z\d][\w-]*)/ig, '$1<a class="hashtag">$2</a>'));

			$form = $('.feed-load[data-type="'+type+'"][data-iid="'+id+'"] form.comment-form-feed');
			formID = $form.attr('id');
			rate('#'+formID);
			validator('#'+formID, href);
			likeFeed($feed);
		}
	})
}

function load () {
	$('span.feed-href').each(function () {
		$this = $(this);
		$feed = $this.closest('.feed-load');
		type = $feed.attr('data-type');
		iid = $feed.attr('data-iid');
		href = MAIN_URL+'/'+$this.text()+'?temp=feed';
		loadFeed(href, $feed, iid, type);
	})
}

$(document).ready(function () {
	load();
	$('#join').click(function () {
		$.post('?do=join', function (data) {
			if (data == 1) {
				mtip('', 'success', '', 'Success!');
				location.reload();
			} else {
				mtip('', 'error', '', 'Oops! Something went wrong!');
			}
		})
	})
})
