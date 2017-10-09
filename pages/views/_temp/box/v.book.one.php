<div class="col-lg-9 no-padding-left">
	<h3 class="box-book-title"><?php echo $box->book_title ?>
	<?php if ($config->u && $config->me['is_mod'] === 1) {
			echo '<a class="box-book-manage" href="?mode=editbooks&b='.$box->book_id.'"><i class="fa fa-pencil"></i></a>';
		} ?>
	</h3>
	<div class="col-lg-3 no-padding">
		<div class="box-squares-thumb">
		<?php for ($i = 1; $i <= $boxView['squares']; $i++) {
			if ($box->book_square_id == $i) $cls = ' active';
			else $cls = ''; 
			echo '<div class="box-one-square'.$cls.'" style="width:'.$boxView['widthPerSquare'].'%"><div class="box-square-one-id">'.$i.'</div></div>';
			if ($i%$boxView['cols'] == 0) echo '<div class="clearfix"></div>';
		} ?>
		<?php for ($i = 0; $i < $boxView['rows']; $i++) { ?>
		<?php } ?>
		</div>
	</div>
	<div class="col-lg-9 no-padding-right box-book-main-data">
		<div class="col-lg-6 box-book-info no-padding-right">
			<div class="box-book-barcode" data-num="<?php echo $box->book_num ?>">Square ID: <?php echo $box->book_square_id ?></div>
			<div class="box-book-num" data-num="<?php echo $box->book_num ?>">Số lượng còn lại: <strong class="text-<?php echo ($box->book_num) ? 'success' : 'danger' ?>"><?php echo  $box->book_num; if (!$box->book_num) echo ' (Hết hàng)' ?></strong></div>
			<div class="box-book-barcode" data-num="<?php echo $box->book_num ?>">ISBN: <?php echo $box->book_barcode ?></div>
		</div> <!-- .box-book-info -->
		<div class="col-lg-6 no-padding">
			<div class="box-book-action right">
				<a class="btn btn-red btn-buy" href="?b=<?php echo $box->book_id ?>&mode=buy">Mua ($<?php echo $box->book_price ?>)</a>
				<a class="btn btn-success btn-borrow" href="?b=<?php echo $box->book_id ?>&mode=borrow">Mượn ($<?php echo $box->book_price_rent ?>)</a>
			</div> <!-- .box-book-action -->
		</div> <!-- .col-lg-6 -->
		<div class="clearfix"></div>
		<div id="book_rate_data"></div>
	</div> <!-- .box-book-main-data -->
	<div class="clearfix"></div>
</div>

<div class="col-lg-3 no-padding">
	<img class="box-book-cover" width="100%" src="<?php echo $box->book_coverIMG ?>"/>
</div>

<div class="clearfix"></div>

<div id="book_data"></div>

<div class="more-boxes">
	<div class="other_boxes"></div>
</div>

<div class="s-buy"></div>
