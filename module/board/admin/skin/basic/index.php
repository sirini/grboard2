<?php if(!defined('GR_BOARD_2')) exit(); ?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>GR Board 2 - Board - Control Center</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/<?php echo $skinResourcePath; ?>/index.css" rel="stylesheet" media="screen" />
		<script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?php echo $_SERVER['HTTP_HOST']; ?></a>
			</div>
			
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" title="<?php echo $lang['home_info']; ?>">
						<span class="glyphicon glyphicon-home"></span> Home</a></li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" href="#">
						Board <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/<?php echo $grboard; ?>/board/admin/board/add" title="<?php echo $lang['board_add_info']; ?>">
								<span class="glyphicon glyphicon-plus"></span> Add</a></li>
							<li><a href="/<?php echo $grboard; ?>/board/admin/board/list" title="<?php echo $lang['board_list_info']; ?>">
								<span class="glyphicon glyphicon-list-alt"></span> List</a></li>
							<li><a href="/<?php echo $grboard; ?>/board/admin/board/group" title="<?php echo $lang['board_group_info']; ?>">
								<span class="glyphicon glyphicon-th-large"></span> Group</a></li>
						</ul>
					</li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" href="#">
						Member <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/<?php echo $grboard; ?>/board/admin/member/add" title="<?php echo $lang['member_add_info']; ?>">
								<span class="glyphicon glyphicon-user"></span> Add</a></li>
							<li><a href="/<?php echo $grboard; ?>/board/admin/member/list" title="<?php echo $lang['member_list_info']; ?>">
								<span class="glyphicon glyphicon-list-alt"></span> List</a></li>
							<li><a href="/<?php echo $grboard; ?>/board/admin/member/group" title="<?php echo $lang['member_group_info']; ?>">
								<span class="glyphicon glyphicon-th-large"></span> Group</a></li>
						</ul>
					</li>
					<li><a href="/<?php echo $grboard; ?>/board/admin/advanced/terminal" title="<?php echo $lang['advanced_terminal_info']; ?>">
						<span class="glyphicon glyphicon-wrench"></span> Terminal
					</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://sirini.net/" title="Build GR Board 2 better, together."> 
						<span class="glyphicon glyphicon-link"></span> GR Board <sup>2</sup></a></li>
				</ul>
			</div>
		</div>
	</nav>			
	
	<div class="container">
		<?php include 'module/board/admin/' . $panel . '/' . $target . '.php'; ?>
	</div>

	</body>
</html>