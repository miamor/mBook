<?php foreach ($_List as $oE) { ?>
<div class="one-event box">
<div class="box-header with-border"><h4 class="one-event-title"><a href="<?php echo $oE['link'] ?>"><?php echo $oE['title'] ?></a></h4></div>
<div class="box-body">
	<div class="one-event-start">
		<div class="ev-day"><?php echo $oE['start']['day'] ?></div>
		<div class="ev-month"><?php echo $oE['start']['month'] ?></div>
		<div class="ev-year"><?php echo $oE['start']['year'] ?></div>
	</div>
	<div class="one-event-des">
		<?php echo preg_replace("#(<br */?>\s*)+#i", "<br/>", $oE['des']) ?>
	</div>
</div>
<div class="box-footer">
	<div class="col-lg-6 no-padding">
		<i class="fa fa-map-marker"></i> <a href="https://www.facebook.com/<?php echo $oE['place']['location']['id'] ?>"><?php echo $oE['place']['location']['city'] ?></a>
	</div>
	<div class="col-lg-6 no-padding-right text-right">
		<i class="fa fa-facebook"></i> <a href="https://www.facebook.com/<?php echo $oE['id'] ?>"><?php echo $oE['fb_id'] ?></a>
	</div>
</div>
</div>
<?php } ?>
