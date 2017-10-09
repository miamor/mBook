var types = $('input[name="post_type"]:checked').map(function() {
	return this.value;
}).get();
var hashtag = [];
types.splice(types.indexOf('write'), 1);
types.push('chapter-w');
types.push('chapter');

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

function checkFeed ($feed) {
	$feed.hide();
	if (hashtag.length) {
//		console.log(checkHashtag($feed, hashtag));
		if (checkHashtag($feed, hashtag) == true) {
			fType = $feed.attr('data-type');
			if (fType == 'chapter-w' || fType == 'chapter') fType = 'write';
			if (types.indexOf(fType) > -1) {
				if (!$feed.is('.hide')) $feed.show();
			}
		} else $feed.hide();
	} else {
		$.each(types, function (i, v) {
			$('.feed-load[data-type="'+v+'"]').not('.hide').show()
		});
	}
	toggleGroup();
/*	if (!$feed.attr('style') == "display: none;") {
		$feed.closest('.one-group-feed').hide()
	}
*/
}

function loadFeed (href, $feed, id, type) {
//	console.log(href);
	$.ajax({
		url: href,
		type: 'get',
		success: function (data) {
			$feed.html(data);
			$fContent = $feed.find('.feed-main-content');
			
			regex = /(^|\W)(#[a-z\d][\w-]*)/ig;
			regexx = /(^|\W)(?!.*=\")(#[a-z\d][\w-]*)/ig;
			//console.log($fContent.html());
			if (regexx.test($fContent.html())) {
				$fContent.html($fContent.html().replace(regexx, '$1<a class="hashtag">$2</a> '));
			}

			$form = $('.feed-load[data-type="'+type+'"][data-iid="'+id+'"] form.comment-form-feed');
			formID = $form.attr('id');
			
			if (!$feed.find('.box-comments').find('div').length) $feed.find('.box-comments').hide();
			else $feed.find('.box-comments').show();
			
			if ($('.nav-users .s-title').length) {
				rate('#'+formID);
				validator('#'+formID, href);
				likeFeed($feed);
			}
			checkFeed($feed);
		}
	})
}

function checkHashtag ($a, hashtag) {
	var ok = false;
	$a.find('.feed-main-content a').each(function () {
//		console.log(hashtag.indexOf($(this).text()));
		if (hashtag.indexOf($(this).text()) > -1) {
//			console.log($(this).text());
			ok = true;
			return true;
		}
	});
	return ok;
}

function filtPost () {
//	console.log(types);
//	console.log(hashtag);
	$('.feed-load').hide();
	if (hashtag.length) {
		$.each(hashtag, function (i, v) {
//			console.log(v);
			$('.feed-load:has(.feed-main-content:contains("'+v+'"))').each(function () {
				$feed = $(this);
				if (checkHashtag($(this), hashtag) == true) {
					fType = $(this).attr('data-type');
					if (fType == 'chapter-w' || fType == 'chapter') fType = 'write';
					if (types.indexOf(fType) > -1) {
						if (!$feed.is('.hide')) $feed.show();
					}
				}
			});
		});
	} else {
		$.each(types, function (i, v) {
			$('.feed-load[data-type="'+v+'"]').not('.hide').show()
		});
	}
	toggleGroup();
}

function toggleGroup () {
	$('.one-group-feed').each(function () {
		if (!$(this).find('.feed-load[style="display: block;"]').length) {
			$(this).hide();
		} else {
			$(this).show();
		}
	})
}


function filter () {
	filter_Hashtag();
	filter_Types()
}
function filter_Hashtag () {
	$('.one-hashtag').click(function () {
		text = $(this).text();
		if ($(this).is('.selected')) {
			$(this).removeClass('selected');
			hashtag.splice(hashtag.indexOf(text), 1);
		}
		else {
			$(this).addClass('selected');
			hashtag.push(text);
		}
		filtPost();
		return false;
	});
}
function filter_Types () {
	$('input[name="post_type"]').each(function () {
		$(this).change(function () {
			val = $(this).val();
			if ($(this).is(':checked')) {
				if (val == 'write') {
					types.push('chapter');
					types.push('chapter-w');
				}
				else types.push(val);
			}
			else {
				if (val == 'write') {
					types.splice(types.indexOf('chapter'), 1);
					types.splice(types.indexOf('chapter-w'), 1);
				}
				else types.splice(types.indexOf(val), 1);
			}
			filtPost();
		});
	})
}

function loadMorePage (page) {
	$('#post-list').append(loading);
	$.get('?do=get&page='+page, function (data) {
		$('#post-list .loading').remove();
		if (data) {
			$('#post-list').append(data);
			load();
			switchPost($('#post-list .one-group-feed:last'));
		}
		else {
			$('#post-list').append('<div class="end-of-result">Hết dữ liệu.</div>');
		}
	})
}

var page = 1;
$(window).scroll(function () {
	if (!$('.end-of-result').length) {
//		console.log($(window).scrollTop() + $(window).height());
//		console.log($(document).height()-600);
//		console.log('');
		if ( ($(window).scrollTop() + $(window).height() >= $(document).height()-20) && !$('#post-list .loading').length) {
			loadMorePage(page);
			page++;
		}
	}
});

function switchPost ($a) {
	$a.find('.change-button').click(function () {
		$this = $(this);
		$group = $(this).closest('.one-group-feed');
		$active = $group.find('.feed-load.active');
		$first = $group.find('.feed-load').eq(0);
		$last = $group.find('.feed-load').last();
		$next = $active.next('.feed-load');
		$prev = $active.prev('.feed-load');
		if ($this.is('.next-button')) {
			if ($next.attr('data-iid')) {
				$active.removeClass('active').addClass('hide').hide();
				$next.removeClass('hide').addClass('active').show();
			} else {
				$active.removeClass('active').addClass('hide').hide();
				$first.removeClass('hide').addClass('active').show();
			}
		} else {
			if ($prev.attr('data-iid')) {
				$active.removeClass('active').addClass('hide').hide();
				$prev.removeClass('hide').addClass('active').show();
			} else {
				$active.removeClass('active').addClass('hide').hide();
				$last.removeClass('hide').addClass('active').show();
			}
		}
	})
}

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

function followFriend (fID, data, k) {
	$('a.follow-fb-friend[data-u="'+fID+'"]').click(function () {
		$.post('?do=follow&u='+fID, function (response) {
			if (response == 1) {
				$('a.follow-fb-friend[data-u="'+fID+'"]').closest('.fb-one-friend').remove();
				showFriends(data, k, 1);
			}
		});
		return false
	})
}

function showFriends (data, start, num) {
	k = start;
	$.each(data, function (i, uInfo) {
		if (uInfo && k < num) {
			html = '<div class="fb-one-friend left div-'+k+'">\
				<img class="left img-circle fb-one-friend-thumb" src="'+uInfo['avatar']+'"/>\
				<div class="fb-one-friend-info">\
					<a href="'+uInfo['link']+'">'+uInfo['name']+'</a>\
					<div class="fb-one-friend-btns">\
						<a href="#" class="btn btn-success follow-fb-friend btn-sm" data-u="'+uInfo['id']+'">Follow</a>\
					</div>\
				</div>\
				<div class="clearfix"></div>\
			</div>';
			$('.fb_friends').append(html);
			k++;
			followFriend(uInfo['id'], data, k);
		}
	});

}

function getFriends () {
	$.getJSON('?do=getFriends', function (data) {
		if (data.length) {
			$('#fb_friends').html('<div class="fb-friend-list">\
					<h4>Bạn bè của bạn trên facebook. Theo dõi họ trên mBook để không bỏ lỡ các hoạt động của họ!</h4>\
					<div class="fb_friends"></div>\
					<div class="clearfix"></div></div>');
			showFriends(data, 0, 5);
	//		$('.fb_friends').append(data);
		}
	})
}

function getEvents () {
	$.get(MAIN_URL+'/event?temp=feed', function (data) {
		$('#events .clearfix').before(data);
	})
}

function switchUser () {
	$('.switch-user').click(function () {
		$('.feed-form-avt,.feed-post-user-avt').attr('src', $(this).find('.feed-switch-user-avt').attr('src'));
		$('.feed-post-by').val($(this).attr('id'));
		return false
	})
}

function textAreaSceAdjust ($div) {
	o = $div.find('.sceditor-container').find('iframe').contents().find('html')[0];
	div = $('.stt-form .sceditor-container')[0];
	iframe = $('.stt-form .sceditor-container iframe')[0];
		div.style.height = "1px";
		iframe.style.height = "1px";
	div.style.height = (o.scrollHeight+50)+"px";
	iframe.style.height = (o.scrollHeight+5)+"px";
/*	if (iframe.scrollHeight < o.scrollHeight) {
	}
	textarea = $('.stt-form textarea[dir="ltr"]')[0];
	textarea.style.height = (o.scrollHeight)+"px";
*/}

$(document).ready(function () {
	loadMorePage(0);
	
	// load review form
	if (!$('#form_review .new-review').length) {
			$.get(MAIN_URL+'/review?mode=new&temp=feed', function (data) {
				$('#form_review').html(data);
				$('#form_review .feed-rv-book').remove();
				$('.feed-advertise').prepend('<div class="feed-rv-book hide"><i class="preview-not-avai">Xem trước sách không khả dụng</i></div>');
				sce('.review-content');
				validator('#form_review .new-review');
				choosen('#form_review');
				$('#form_review :checkbox').not('[data-toggle="switch"], .onoffswitch-checkbox').checkbox();
				$('#form_review :radio').radio();
			})
	}

	filter();
	load();
	getFriends();
	getEvents();
	switchUser();

	$('#post-list .one-group-feed').each(function () {
		switchPost($(this));
	});

/*	$('#stt-textarea-div').on('blur keyup paste input', function () {
		var ctl = document.getElementById('Javascript_example');
		var startPos = ctl.selectionStart;
		var data = decodeEntities($(this).html());
		$(this).html(data);
		$('.stt-form textarea.stt-textarea').val(data);
	});
*/
	if ($('textarea.stt-textarea').length) {
		$('textarea.stt-textarea').sceditor('instance').keyUp(function (data) {
			textAreaSceAdjust($('.stt-form'));
		});
		$('a[href="#form_status"]').click(function () {
			$('.feed-advertise .feed-rv-book').hide();
		})
		$('a[href="#form_review"]').click(function () {
			if ($('#form_review').is('.active')) return;
			if ($('#form_review .new-review').length) {
				$('.feed-advertise .feed-rv-book').show();
				return;
			}
		});
	}
})
