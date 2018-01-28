<?php if(!defined('GR_BOARD_2')) exit(); ?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>GR Board 2 | 게시판 관리</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

	    <script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
    	<script src="/<?php echo $grboard; ?>/lib/popper.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/bootstrap-material-design.min.js"></script>
		<script>
		$(function(){
			$("body").bootstrapMaterialDesign();
			$('[data-toggle="tooltip"]').tooltip();			
		});
		</script>
	</head>
	<body>
	
	<nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
		<a class="navbar-brand" href="#"><?php echo $_SERVER['HTTP_HOST']; ?></a>
			
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#grboard2TopNav" aria-controls="grboard2TopNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggle-icon"></span>
		</button>		
		
		<div id="grboard2TopNav" class="navbar-collapse collapse">
			<ul class="nav navbar-nav mr-auto">
				<li class="nav-item active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" data-toggle="tooltip" title="사이트 첫 화면으로 이동 합니다" class="nav-link">
					Home</a></li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" role="button" id="navBBSMenu" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
					게시판 관리</a>
					<div class="dropdown-menu" aria-labelledby="navBBSMenu">
						<a class="dropdown-item" href="/<?php echo $grboard; ?>/board/admin/board/add" 
							data-toggle="tooltip" data-placement="right" title="<?php echo $lang['board_add_info']; ?>">게시판 추가하기</a>
						<a class="dropdown-item" href="/<?php echo $grboard; ?>/board/admin/board/list"
							data-toggle="tooltip" data-placement="right" title="<?php echo $lang['board_list_info']; ?>">게시판 목록보기</a>
						<a class="dropdown-item" href="/<?php echo $grboard; ?>/board/admin/board/group"
							data-toggle="tooltip" data-placement="right" title="<?php echo $lang['board_group_info']; ?>">게시판 그룹보기</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" role="button" id="navMemberMenu" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
					회원 관리</a>
					<div class="dropdown-menu" aria-labelledby="navMemberMenu">
						<a class="dropdown-item" href="/<?php echo $grboard; ?>/board/admin/member/add" 
							data-toggle="tooltip" data-placement="right" title="<?php echo $lang['member_add_info']; ?>">회원 직접 추가하기</a>
						<a class="dropdown-item" href="/<?php echo $grboard; ?>/board/admin/member/list"
							data-toggle="tooltip" data-placement="right" title="<?php echo $lang['member_list_info']; ?>">회원 목록보기</a>
						<a class="dropdown-item" href="/<?php echo $grboard; ?>/board/admin/member/group"
							data-toggle="tooltip" data-placement="right" title="<?php echo $lang['member_group_info']; ?>">회원 그룹보기</a>
					</div>
				</li>
				<li class="nav-item"><a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
					GR Board <sup>2</sup></a></li>
			</ul>
		</div>
	</nav>			
	
	<div class="container">
		<div class="card bg-light">
			<?php include 'module/board/admin/' . $panel . '/' . $target . '.php'; ?>
		</div>
	</div>

	</body>
</html>