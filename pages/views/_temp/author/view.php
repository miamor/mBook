<div class="col-lg-1"></div>
<div class="col-lg-6">
	<h2><?php echo $name ?></h2>
	<div class="author-des">
	<?php echo $des ?>
	</div>
</div>
<div class="col-lg-4">
	<h3>Tác phẩm</h3>
<?php foreach ($works as $ow) { ?>
	<div class="one-work">
		<img class="one-work-thumb" src="<?php echo $ow['thumb'] ?>"/>
		<div class="one-work-title">
			<a href="<?php echo $ow['link'] ?>"><?php echo $ow['title'] ?></a>
		</div>
	</div>
<?php } ?>
</div>
<div class="clearfix"></div>