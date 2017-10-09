<!--<h2>Tìm kiếm "<?php echo $search->keyword ?>"</h2>

<div class="search-page">
	<h3>Dữ liệu từ mBook</h3>
</div>

<div class="search-goodreads">
	<h3>Dữ liệu từ goodreads</h3>
	
</div>-->
<div class="s-response">
	<div class="col-lg-7 s-book-info no-padding-left">
		<h2 id="s-title"><?php echo $response['title'] ?></h2>
		<div class="s-author">
			Tác giả: <a href="#" id="s-author"><?php echo $response['author_txt'] ?></a>
		</div>
		<div class="s-des box">
			<h3 class="box-header with-border">Tóm tắt</h3>
			<div class="box-body">
				<?php echo $response['des'] ?>
			</div>
		</div>
		
		<div class="s-download">
			<div id="s-download">
<?php if ($response['download']) { ?>
<div class="book-download-links">
	<div class="report-link right">
		<a href="?do=report_link" class="gensmall" style="margin-top:2px">Báo cáo link hỏng</a>
	</div>
	<label class="download-label" style="margin-bottom:10px;text-transform:capitalize"><h3 class="no-margin">Download</h3></label>
	<?php foreach ($response['download'] as $k => $oneLink) 
		echo '<a class="one-link" href="'.$oneLink.'">Link '.($k+1).'</a>'; ?>
	<div class="clearfix"></div>
</div>
<?php } else echo '<div class="alerts alert-warning">Download link chưa được updare. Chúng tôi sẽ sớm khắc phục lỗi này.</div>' ?>
			</div>
		</div>
<style>.download-label:after{margin-top:2px;left:110px}</style>	

	</div>
	
	<div class="s-ratings col-lg-5 no-padding">
		<div class="s-overview col-lg-4 no-padding">
			<div class="s-score"><?php echo $response['ratings']['average'] ?></div>
			<div class="s-ratings-details">
				<div class="ratings s-star">
					<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
				</div>
				<span class="s-rate-total">Tổng số: <?php echo $response['ratings']['total'] ?></span>
			</div>
		</div>
		<div class="s-details col-lg-8 no-padding">
		<?php for ($i = 5; $i >= 1; $i--) {
			$rPer = $response['ratings']['detail'][$i]['percent'];
			$rTot = $response['ratings']['detail'][$i]['total'];
			if ($response['ratings']['total'] > 0) {
				$grPer = number_format(100*$response['ratings']['goodreads']['detail'][$i]/$response['ratings']['total'], 2);
				$lcPer = number_format(100*$response['ratings']['local']['detail'][$i]/$response['ratings']['total'], 2);
			} else $grPer = $lcPer = 0; ?>
			<div class="rate-bar-label col-lg-2 no-padding">
				<i class="fa fa-star"></i> <?php echo $i ?>
			</div>
			<div data-per="<?php echo $rPer ?>" class="rate-bar col-lg-10 no-padding rate-bar-<?php echo $i ?>">
				<span class="rate-bar-num"><?php echo $rPer ?>% (<?php echo $rTot ?>)</span>
<!--				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $rPer ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rPer ?>%;position:absolute"></div>
-->
				<div class="progress-bar rate-bar-fill rate-bar-goodreads" role="progressbar" aria-valuenow="<?php echo $grPer ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $grPer ?>%"></div>
				<div class="progress-bar rate-bar-fill rate-bar-local" role="progressbar" aria-valuenow="<?php echo $lcPer ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $lcPer ?>%"></div>
			</div>
		<?php } ?>
		</div>
		<div class="clearfix"></div>
		
		<div class="s-ratings-list">
			<input class="bookLink" type="hidden" value="<?php echo $response['local']['link'] ?>"/>
<div class="nav-tabs-customs">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#rv_local" data-toggle="tab">mBook</a></li>
		<li><a href="#rv_goodreads" data-toggle="tab">Goodreads</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="rv_local">
			
		</div><!-- /.tab-pane -->
		<div class="tab-pane" id="rv_goodreads">
			
		</div><!-- /.tab-pane -->
	</div><!-- /.tab-content -->
</div>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="more-boxes"><div class="other_boxes"></div></div>
	<div class="s-buy"></div>

	<div class="clearfix"></div>
</div>
