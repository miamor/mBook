<?php //echo date("Y-m-d H:i:s");
$config->addJS('plugins', 'bootstrapValidator/bootstrapValidator.min.js');
$config->addJS('plugins', 'sceditor/minified/jquery.sceditor.min.js');
$config->addJS('dist', 'main.js'); ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMG ?>/b.jpg" />

	<title><?php echo $page_title ?></title>

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo MAIN_URL ?>/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo CSS ?>/font.min.css">
	<link rel="stylesheet" href="<?php echo CSS ?>/plugins.css">
	<!-- Page style CSS -->
	<link rel="stylesheet" href="<?php echo MAIN_URL ?>/admin/assets/css/light.css">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo MAIN_URL ?>/assets/jquery/jquery-2.2.3.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo MAIN_URL ?>/assets/bootstrap/js/bootstrap.min.js"></script>
	<script>var MAIN_URL = '<?php echo MAIN_URL ?>/admin' </script>

</head>
<body>

	<div id="top_navbar" class="header">
		<div class="col-lg-1"></div>
		<div class="top-left col-lg-3">
			<div class="logo">
				<a href="<?php echo MAIN_URL ?>">
					<span class="txt">m</span>
					<img class="b-letter" src="<?php echo IMG ?>/b.jpg" alt="mBook">
					<span class="txt">ook</span>
				</a>
			</div>
		</div> <!-- .top-left -->

		<div class="col-lg-1 right"></div>
		<div class="top-right col-lg-4 right text-right">
			<div class="user-right-bar right">
				<ul class="nav-users">
					<li class="dropdown">
						<a href="#">
							<img src="<?php echo ($config->u) ? $config->me['avatar'] : MAIN_URL.'/data/img/anonymous.jpeg' ?>" class="avatar img-circle">
							<strong class="s-title"><?php echo ($config->u) ? $config->me['name'] : '[Guests]' ?></strong>
							<?php if ($config->u) echo '<span class="hidden myID" id="'.$config->me['username'].'"></span>' ?>
						</a>
					</li>
				</ul>
			</div>
		</div> <!-- .top-right -->
	</div>

	<nav class="navbars">
		<div class="col-lg-1"></div>
		<div class="col-lg-8 no-padding">
			<ul class="items-list">
				<li class="one-item <?php if ($page == 'home') echo 'active' ?>" id="home"><a href="<?php echo MAIN_URL ?>">Feed</a></li>
				<li class="one-item <?php if ($page == 'book') echo 'active' ?>" id="book">
					<a href="<?php echo MAIN_URL ?>/book">Sách</a>
				</li>
				<li class="one-item <?php if ($page == 'write') echo 'active' ?>" id="write">
					<a href="<?php echo MAIN_URL ?>/write">Viết</a>
				</li>
<!--				<li class="one-item <?php if ($page == 'review') echo 'active' ?>" id="review">
					<a href="<?php echo MAIN_URL ?>/review">Đánh giá</a>
				</li>
				<li class="one-item <?php if ($page == 'gift') echo 'active' ?>" id="gift">
					<a href="<?php echo MAIN_URL ?>/gift">Quà tặng</a>
				</li> -->
				<li class="one-item <?php if ($page == 'group') echo 'active' ?>" id="group">
					<a href="<?php echo MAIN_URL ?>/group">Nhóm</a>
				</li>
<!--				<li class="one-item <?php if ($page == 'event') echo 'active' ?>" id="event">
					<a href="<?php echo MAIN_URL ?>/event">Events</a>
				</li>
				<li class="one-item <?php if ($page == 'ask') echo 'active' ?>" id="ask">
					<a href="<?php echo MAIN_URL ?>/ask">Ask</a>
				</li> -->
				<li class="one-item <?php if ($page == 'request') echo 'active' ?>" id="request">
					<a href="<?php echo MAIN_URL ?>/request">Yêu cầu</a>
				</li>
				<li class="one-item <?php if ($page == 'storage') echo 'active' ?>" id="storage">
					<a href="<?php echo MAIN_URL ?>/storage">Kho</a>
				</li>
			</ul>
		</div>

		<div class="col-lg-2 form-search">
			<form class="search-form">
				<input name="keywords" class="search-input" placeholder="Input something..." type="text">
				<div id="search_button" class="search-button"></div>
			</form>
		</div>
		
	</nav>


	<div id="main-content" class="page-<?php echo $page ?>">
		<div class="col-lg-3" id="left-side">
			<?php include 'pages/views/_temp/left.php' ?>
		</div>
		<div class="col-lg-9" id="main">
		