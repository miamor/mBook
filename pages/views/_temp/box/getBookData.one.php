<div class="book_rate_data">
<div class="s-ratings box" style="margin:20px 0">
	<div class="box-body" style="padding:20px 0">
		<div class="s-overview col-lg-4">
			<div class="s-score"><?php echo $box->book_response['ratings']['average'] ?></div>
			<div class="s-ratings-details">
				<div class="ratings s-star">
					<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
				</div>
				<span class="s-rate-total">Tổng số: <?php echo $box->book_response['ratings']['total'] ?></span>
			</div>
		</div>
		<div class="s-details col-lg-8 no-padding">
		<?php for ($i = 5; $i >= 1; $i--) {
			$rPer = $box->book_response['ratings']['detail'][$i]['percent'];
			$rTot = $box->book_response['ratings']['detail'][$i]['total'];
			if ($box->book_response['ratings']['total'] > 0) {
				$grPer = number_format(100*$box->book_response['ratings']['goodreads']['detail'][$i]/$box->book_response['ratings']['total'], 2);
				$lcPer = number_format(100*$box->book_response['ratings']['local']['detail'][$i]/$box->book_response['ratings']['total'], 2);
			} else $grPer = $lcPer = 0; ?>
			<div class="rate-bar-label col-lg-1 no-padding">
				<i class="fa fa-star"></i> <?php echo $i ?>
			</div>
			<div data-per="<?php echo $rPer ?>" class="rate-bar col-lg-11 no-padding rate-bar-<?php echo $i ?>">
				<span class="rate-bar-num"><?php echo $rPer ?>% (<?php echo $rTot ?>)</span>
<!--				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $rPer ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rPer ?>%;position:absolute"></div>
-->
				<div class="progress-bar rate-bar-fill rate-bar-goodreads" role="progressbar" aria-valuenow="<?php echo $grPer ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $grPer ?>%"></div>
				<div class="progress-bar rate-bar-fill rate-bar-local" role="progressbar" aria-valuenow="<?php echo $lcPer ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $lcPer ?>%"></div>
			</div>
		<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

		<div class="s-author" style="margin-top:20px">
			Tác giả: <a href="#" id="s-author"><?php echo $box->book_response['author_txt'] ?></a>
		</div>
</div>

<div class="col-lg-8 no-padding-left">
	<div class="s-des book-des box">
		<h3 class="box-header with-border">Tóm tắt</h3>
		<div class="des box-body">
			<?php echo $box->book_response['des'] ?>
		</div>
	</div>

</div>
<div class="col-lg-4 no-padding">
	<div class="s-download" style="margin:30px 0">
		<div id="s-download">
<?php if ($box->book_response['download']) { ?>
<div class="book-download-links">
	<div class="report-link right">
		<a href="?do=report_link" class="gensmall right" style="margin-top:10px">Báo cáo link hỏng</a>
	</div>
	<label class="download-label" style="margin-bottom:10px;text-transform:capitalize"><h3 class="no-margin">Download</h3></label>
	<?php foreach ($box->book_response['download'] as $k => $oneLink) 
		echo '<a class="one-link" href="'.$oneLink.'">Link '.($k+1).'</a>'; ?>
	<div class="clearfix"></div>
</div>
<?php } else echo '<div class="alerts alert-warning">Download link chưa được updare. Chúng tôi sẽ sớm khắc phục lỗi này.</div>' ?>
		</div>
	</div> <!-- .s-download -->
	<style>.download-label:after{margin-top:5px;left:110px}</style>	

	<div class="s-ratings-list">
		<h3>Đánh giá</h3>
		<input class="bookLink" type="hidden" value="<?php echo $box->book_response['local']['link'] ?>"/>
		<div id="rv_local">
		</div><!-- #rv_local -->
	</div>
</div>
<div class="clearfix"></div>
