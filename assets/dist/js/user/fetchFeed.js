function likeFeed ($element) {
	if ($element.find('.post-like').length) {
		$element.find('.post-like').click(function () {
			$this = $(this);
			$.post(MAIN_URL+'/status/'+$this.attr('id')+'?do=like', function (data) {
				if (data == 1) {
					if ($this.is('.liked')) {
						$this.removeClass('liked');
						$this.find('strong').text(Number($this.find('strong').text()) - 1);
					} else {
						$this.addClass('liked');
						$this.find('strong').text(Number($this.find('strong').text()) + 1);
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
			
			regex = /(^|\W)(#[a-z\d][\w-]*)/ig;
			regexx = /(^|\W)(?!.*=\")(#[a-z\d][\w-]*)/ig;
			$fContent.html($fContent.html().replace(regexx, '$1<a class="hashtag">$2</a> '));

			$form = $('.feed-load[data-type="'+type+'"][data-iid="'+id+'"] form.comment-form-feed');
			formID = $form.attr('id');
			rate('#'+formID);
			validator('#'+formID, href);
			likeFeed($feed);
		}
	})
}

var page = 1;
$(window).scroll(function () {
	if (!$('.end-of-result').length) {
		if ($(window).scrollTop() + $(window).height() == $(document).height()) {
			$('#post-list').append(loading);
			$.get('?do=get&page='+page, function (data) {
				$('#post-list .loading').remove();
				if (data) {
					$('#post-list').append(data);
					page++;
					load();
				}
				else {
					$('#post-list').append('<div class="end-of-result">Hết dữ liệu.</div>');
				}
			})
		}
	}
});

function load () {
	$('span.feed-href').each(function () {
		$this = $(this);
		$feed = $this.closest('.feed-load');
		type = $feed.attr('data-type');
		iid = $feed.attr('data-iid');
		href = '';
		if ($this.text().indexOf(MAIN_URL) <= -1) 
			href += MAIN_URL+'/';
		href += $this.text();
		if (href.indexOf('?') > -1) href += '&temp=feed';
		else href += '?temp=feed';
//		console.log(href);
		loadFeed(href, $feed, iid, type);
	})
}

function textAreaAdjust (o) {
	o.style.height = "1px";
	o.style.height = (o.scrollHeight)+"px";
}

function switchUser () {
	$('.switch-user').click(function () {
		$('.feed-form-avt,.feed-post-user-avt').attr('src', $(this).find('.feed-switch-user-avt').attr('src'));
		$('.feed-post-by').val($(this).attr('id'));
		return false
	})
}

$(document).ready(function () {
	load();
	switchUser();
	$('a[href="#form_status"]').click(function () {
		$('.feed-advertise .feed-rv-book').hide();
	})
})
