<?php if(!defined('GR_BOARD_2')) exit(); ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $blogInfo['blog_title']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $skinResourcePath; ?>/skin.css" />
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

	<div id="wrap">
    	<nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
    		<a class="navbar-brand" href="/<?php echo $grboard; ?>/blog/list/page/1"><?php echo $blogInfo['blog_title']; ?></a>
    			
    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#grboard2TopNav" aria-controls="grboard2TopNav" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggle-icon"></span>
    		</button>		
    		
    		<div id="grboard2TopNav" class="navbar-collapse collapse">
    			<ul class="nav navbar-nav mr-auto">
    				<li class="nav-item active">
    					<a href="/<?php echo $grboard; ?>/blog/list/page/1" data-toggle="tooltip" title="사이트 첫 화면으로 이동 합니다" class="nav-link">
    						Home</a></li>
    				<li class="nav-item dropdown">
    					<a href="#" class="nav-link dropdown-toggle" role="button" id="navBlogNotice" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
    					Notice</a>
    					<div class="dropdown-menu" aria-labelledby="navBlogNotice">					
    						<?php foreach($blogNotice as $uid => $subject): ?>
    							<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/view/<?php echo $uid; ?>"><?php echo $subject; ?></a>
    						<?php endforeach; ?>					
    					</div>
    				</li>
    				<li class="nav-item dropdown">
    					<a href="#" class="nav-link dropdown-toggle" role="button" id="navBlogMenu" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
    					Menu</a>
    					<div class="dropdown-menu" aria-labelledby="navBlogMenu">
    						<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/guestbook" 
    							data-toggle="tooltip" data-placement="right" title="방명록에 글을 남겨 주세요! ^^">Guestbook</a>
    						<?php if(!$Common->getSessionKey()): ?>
    						<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/login"
    							data-toggle="tooltip" data-placement="right" title="로그인을 합니다">Login</a>
    						<?php else: ?>
    						<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/write"
    							data-toggle="tooltip" data-placement="right" title="블로그에 새로운 글을 작성 합니다">Write</a>
    						<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/logout"
    							data-toggle="tooltip" data-placement="right" title="로그아웃 합니다">Logout</a>
    						<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/admin"
    							data-toggle="tooltip" data-placement="right" title="블로그 관리 페이지로 이동 합니다">Admin</a>
    						<?php endif; ?>
    					</div>
    				</li>				
    				<li class="nav-item">
    					<a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
    						GR Board <sup>2</sup></a></li>
    			</ul>
    			
    			<form id="blogSearchForm" class="form-inline my-2 my-lg-0" method="post" action="/" rel="<?php echo $grboard; ?>">
    				<input id="blogSearchText" type="text" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
    				<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    			</form>
    			
    		</div>
    	</nav>		
	
		<div class="container">
    		<form id="boardLoginForm" method="post" action="/<?php echo $grboard; ?>/blog/login" class="form-signin" role="form">
    			<div class="hiddenInputs">
    				<input type="hidden" name="loginProceed" value="true" />
    			</div>
    			<div id="blogLoginBox" class="card">
    				<h4 class="card-header">Please sign in</h4>
    				<div class="card-body">
					<p class="card-text">
						<div class="form-group">
							<label for="userid">User ID</label>
							<input type="text" id="userid" name="userid" class="form-control" aria-describedby="useridHelp" required="true" autofocus="true" />
							<small id="useridHelp" class="form-text text-muted">이 곳에 사용자 아이디(ID)를 입력해 주세요</small>
						</div>	
						<div class="form-group">
							<label for="passwd">Password</label>
							<input type="password" id="passwd" name="passwd" class="form-control" aria-describedby="passwdHelp" required="true" />
							<small id="passwdHelp" class="form-text text-muted">이 곳에 비밀번호를 입력해 주세요</small>
						</div>
					</p>
					<div class="row">
						<div class="col">
							<input type="submit" class="btn btn-md btn-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="아이디와 비밀번호를 올바르게 입력 하신 후 여기를 클릭해 주세요" value="Sign in" />
						</div>
						<div class="col">
							<a href="<?php echo $prePath; ?>/join/0" data-toggle="tooltip" data-placement="bottom" title="계정이 없을 경우 여기를 클릭하여 회원 가입을 하실 수 있습니다" class="btn btn-md btn-primary btn-block"> 
								JOIN US</a>
						</div>
    				</div>    				
    			</div>
    		</form>
