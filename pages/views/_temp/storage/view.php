<div class="book-info">
	<div class="no-padding-left">
		<h2 class="book-title">
			<?php echo $title ?>
		</h2>
		<div class="col-lg-3 book-left-col no-padding-left">
			<img class="book-thumb" src="<?php echo $thumb ?>"/>

			<div class="go-to-book text-center">
				<a href="<?php echo $bookLink ?>" class="btn btn-block btn-red"><i class="fa fa-download"></i> Go to book page</a>
			</div>

			<div class="book-author">
				<h4 class="about-book-author">Người đóng góp</h4>
				<div class="clearfix"></div>
				<a class="left" data-online="<?php echo $author['online'] ?>" href="<?php echo $author['link'] ?>">
					<img class="user-avatar" src="<?php echo $author['avatar'] ?>"/>
				</a>
				<div class="user-name">
					<div class="book-author-name"><a href="<?php echo $author['link'] ?>"><?php echo $author['name'] ?></a></div>
					<div class="button-follow btn-group">
						<div class="btn btn-follow btn-red btn-sm">
							<span class="fa fa-eye"></span> Follow
						</div>
						<div class="btn btn-default btn-sm num-follow" title="Followers">2</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-lg-9 no-padding">
			<div class="box book-des">
				<div class="box-body">
					<?php echo $des ?>
				</div>
			</div>

			<div class="box book-borrow col-lg-8">
				<h3 class="box-header with-border no-margin">Đăng ký mượn sách</h3>
				<div class="box-body">
					<ul class="book-users-borrow">
						<li class="book-user-borrow-one">
							<a href="#"><img class="book-user-borrow-one-avt" src="http://localhost/rent/data/images/h14.jpg"/> Miamor W.</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="box book-ratings col-lg-4">
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="clearfix"></div>
</div>
