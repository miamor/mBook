<?php if ($config->u) { ?>
<form id="<?php echo $fType.'_'.$fID ?>" class="bootstrap-validator-form box-comment comment-form-status comment-form-feed" action="?do=reply">
	<div class="box-comment-left">
		<a href="<?php echo $config->me['link'] ?>" data-online="<?php echo $config->me['online'] ?>" class="left">
			<img class="img-sm img-circle no-margin-top" src="<?php echo $config->me['avatar'] ?>">
		</a>
	</div>
	<div class="comment-text">
		<div class="col-lg-10 no-padding">
			<textarea name="content" class="form-control cmt-textarea"></textarea>
		</div>
		<div class="col-lg-2 no-padding-right no-padding-top add-form-submit form-one-button right">
			<input type="submit" value="Submit" style="width:100%;height:40px" class="btn btn-red">
		</div>
	</div><!-- /.comment-text -->
</form><!-- /.box-comment -->
<?php } ?>
