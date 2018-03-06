<?php if(!defined('GR_BOARD_2')) exit(); ?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>GR Board 2 | 블로그 관리</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="/<?php echo $skinResourcePath; ?>/style.css" rel="stylesheet" media="screen" />
    	<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    	<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
    	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
        <script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
    	<script src="/<?php echo $grboard; ?>/lib/popper.js"></script>
    	<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/bootstrap-material-design.min.js"></script>
		<script src="/<?php echo $skinResourcePath; ?>/<?php echo $manage; ?>.js"></script>
	</head>
	<body>
	
	<nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
		<a class="navbar-brand" href="#">Administrator's Page</a>
			
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#grboard2TopNav" aria-controls="grboard2TopNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggle-icon"></span>
		</button>		
		
		<div id="grboard2TopNav" class="navbar-collapse collapse">
			<ul class="nav navbar-nav mr-auto">
				<li class="nav-item active">
					<a href="/<?php echo $grboard; ?>/blog/list/page/1" data-toggle="tooltip" title="사이트 첫 화면으로 이동 합니다" class="nav-link">
						Home</a></li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" role="button" id="navBlogMenu" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
					Menu</a>
					<div class="dropdown-menu" aria-labelledby="navBlogMenu">
    					<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/admin/manage/config" data-toggle="tooltip" title="<?php echo $lang['config_info']; ?>">
    						Configuration</a>
    					<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/admin/manage/category" data-toggle="tooltip" title="<?php echo $lang['category_info']; ?>">
    						Category</a>
    					<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/admin/manage/link" data-toggle="tooltip" title="<?php echo $lang['link_info']; ?>">
    						Link</a>
					</div>
				</li>				
				<li class="nav-item">
					<a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
						GR Board <sup>2</sup></a></li>
			</ul>
			
		</div>
	</nav>
		
	<div class="container">
		<?php include $manage.'.php'; ?>
	</div>

	</body>
</html>