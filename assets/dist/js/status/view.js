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

$(document).ready(function () {
	likeFeed($('.feed-load .feed-likes'));
})
