<?php if ($config->u) { ?>
<form id="<?php echo $fType.'_'.$fID ?>" class="bootstrap-validator-form box-comment comment-form-feed">
	<div class="box-comment-left">
		<a href="<?php echo $config->me['link'] ?>" data-online="<?php echo $config->me['online'] ?>" class="left">
			<img class="img-sm img-circle no-margin-top" src="<?php echo $config->me['avatar'] ?>">
		</a>
	</div>
	<div class="comment-text">
	<?php if ($fType != 'status') { ?>
		<div class="form-group no-margin">
			<div class="star-info comment-from-star rating-icons ratings text-warning">
			<?php for ($i = 1; $i <= 5; $i++) {
				echo '<i id="'.$i.'" class="fa fa-star-o rating-star-icon v'.$i.'"></i>';
			} ?>
			</div>
			<input type="hidden" name="rate" class="rate-val"/>
		</div>
	<?php } ?>
		<div class="submit-textarea">
			<textarea name="content" class="form-control cmt-textarea"></textarea>
		</div>
		<div class="col-lg-2 no-padding-right no-padding-top add-form-submit form-one-button right hidden">
			<input type="submit" value="Submit" style="width:100%;height:40px" class="btn btn-red">
		</div>
	</div><!-- /.comment-text -->
</form><!-- /.box-comment -->
<?php } ?>
