<h3 style="margin-bottom:20px"><?php echo $page_title ?></h3>
<?php foreach ($booksList as $boxBook) { ?>
<div class="box-one-book-row">
	<div class="col-lg-1 no-padding">
		<img class="box-one-book-row-thumb left" width="100%" src="<?php echo $boxBook['cover'] ?>"/>
	</div>
	<div class="col-lg-8 no-padding-right">
		<div class="form-group">
			<div class="col-lg-7 box-one-book-row-title no-padding">
				<input class="form-control" type="text" placeholder="Tên sách" value="<?php echo $boxBook['title'] ?>"/>
			</div>
			<div class="col-lg-4 box-one-book-row-num no-padding-right">
				<input class="form-control" type="number" placeholder="Số lượng" value="<?php echo $boxBook['num'] ?>"/>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-lg-3 box-one-book-row-price no-padding">
				<input class="form-control" type="number" placeholder="Giá mua" value="<?php echo $boxBook['price'] ?>"/>
			</div>
			<div class="col-lg-3 box-one-book-row-price_rent no-padding-right">
				<input class="form-control" type="number" placeholder="Giá thuê" value="<?php echo $boxBook['price_rent'] ?>"/>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="box-one-book-row-action">
			<a href="?mode=editbooks&b=<?php echo $boxBook['id'] ?>" style="margin-right:10px"><i class="fa fa-edit"></i> More</a>
			<a href="#" class="text-danger"><i class="fa fa-times"></i> Xóa đầu sách này</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<?php } ?>
