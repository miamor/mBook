function importPages () {
	$('.import-page').not('.disabled').each(function () {
		$(this).click(function () {
			$this = $(this);
			$this.addClass('disabled');
			$form = $this.closest('.fb-one-page').find('form.page-info');
			var formData = $form.serialize();
			$.ajax({
				url: MAIN_URL+'?do=importPage&'+formData,
				success: function (data) {
					if (data == 1) {
						$this.html('<i class="fa fa-checked></i> Imported');
					} else {
						$this.removeClass('disabled');
						mtip('', 'error', '', 'Oops!');
					}
				}
			});
		})
	})
}

$(document).ready(function () {
	$('#get_page').click(function () {
		$('#pages').html(loading);
		$.get(MAIN_URL+'?do=getPages', function (data) {
			$('#pages').html(data);
			importPages();
		})
	})
})
