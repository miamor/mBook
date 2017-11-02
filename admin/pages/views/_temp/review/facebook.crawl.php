<h2>Crawl from group <?php echo $_id ?></h2>

<?php foreach ($review->fb_post[$_id] as $pO) {
	//print_r($pO) ?>
<div class="one-book-row <?php if ($found) echo 'active' ?>" data-id="<?php $pO['id'] ?>">
    <div class="col-lg-1 one-book-actions center">
		<a href="?type=facebook&id=<?php echo $_id ?>&pid=<?php echo $pO['id'] ?>&do=submit"><i class="fa fa-check"></i></a>
    </div>
	<div class="col-lg-8 one-book-message">
	<?php if ($pO['book']) { ?>
		<div class="bold one-book-title">
			<?php echo $pO['book'] ?>
			<span class="one-book-rate text-warning"><?php echo $pO['rate'] ?><i class="fa fa-star"></i></span>
		</div>
		<div class="one-book-content"><?php echo $pO['content'] ?></div>
	<?php } else if ($pO['message']) {
		echo '<div class="italic">'.$pO['message'].'</div>';
	} else if ($pO['story']) {
		echo '<div class="italic one-book-story">(story) '.$pO['story'].'</div>';
	} ?>
		<div class="one-book-fb">
			<i class="fa fa-facebook-square"></i>
			<a href="https://www.facebook.com/<?php echo $pO['id'] ?>"><?php echo $pO['id'] ?></a>
		</div>
    </div>
	<div class="col-lg-3 one-book-created">
        <?php echo $pO['created'] ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php } ?>
