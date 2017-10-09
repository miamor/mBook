<?php if ($config->u) { ?>
<h4>Thêm bình luận</h4>
<form class="ratings-form bootstrap-validator-form" id="f<?php echo $page ?>" action="?do=reply">
	<div class="form-group">
		<div class="col-lg-3 no-padding-left">Đánh giá</div>
		<div class="col-lg-9 no-padding">
			<div class="star-info rating-icons ratings text-warning text-lg">
			<?php for ($i = 1; $i <= 5; $i++) {
		echo '<i id="'.$i.'" class="fa fa-star-o rating-star-icon v'.$i.'"></i>';
			} ?>
			</div>
			<input type="hidden" name="rate" class="rate-val"/>
		</div>
		<div class="clearfix"></div>
	</div>
	<textarea class="form-control" name="content"></textarea>
	<div class="add-form-submit center">
		<input type="reset" value="Reset" class="btn btn-default">
		<input type="submit" value="Submit" class="btn btn-red">
	</div>
</form>
<?php } else echo '<div class="alerts alert-info"><a href="'.MAIN_URL.'/login">Đăng nhập</a> để bình luận.</div>';
