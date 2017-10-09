<div class="box-books-list">
	<h3>Danh sách sách trong book box này</h3>
<?php foreach ($booksList as $boxBook) { ?>
	<div class="box-one-book col-lg-3">
		<div class="flip-container" ontouchstart="this.classList.toggle('hover');">
			<div class="flipper">
				<div class="front">
					<img class="box-one-book-thumb" src="<?php echo $boxBook['cover'] ?>"/>
				</div>
				<div class="back">
					<img class="box-one-book-thumb" src="<?php echo $boxBook['back'] ?>"/>
				</div>
			</div>
		</div>
		<div class="box-one-book-num" data-num="<?php echo $boxBook['num'] ?>"><?php echo $boxBook['num'] ?></div>
		<div class="box-one-book-title">
			<a href="?b=<?php echo $boxBook['id'] ?>"><?php echo $boxBook['title'] ?></a>
		</div>
		<div class="box-one-book-action">
			<a class="btn btn-red btn-buy" href="?b=<?php echo $boxBook['id'] ?>&mode=buy">Mua ($<?php echo $boxBook['price'] ?>)</a>
			<a class="btn btn-success btn-borrow" href="?b=<?php echo $boxBook['id'] ?>&mode=borrow">Mượn ($<?php echo $boxBook['price_rent'] ?>)</a>
		</div>
	</div>
<?php } ?>
</div>
