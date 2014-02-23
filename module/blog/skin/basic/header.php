<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $blogInfo['blog_title']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $skinResourcePath; ?>/skin.css" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen" />
</head>
<body>

	<div id="wrap">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/<?php echo $grboard; ?>/blog/list/page/1"><?php echo $blogInfo['blog_title']; ?></a>
				</div>
				
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/<?php echo $grboard; ?>/blog/list/page/1" title="첫 화면으로 이동 합니다">
							<span class="glyphicon glyphicon-home"></span> Home</a></li>
						<li><a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Notice <b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php foreach($blogNotice as $uid => $subject): ?>
								<li><a href="/<?php echo $grboard; ?>/blog/view/<?php echo $uid; ?>"><?php echo $subject; ?></a></li>
							<?php endforeach; ?>
							</ul>
						</li>
						<li><a href="/<?php echo $grboard; ?>/blog/guestbook"> 
							<span class="glyphicon glyphicon-comment"></span> Guestbook</a></li>
						<?php if(!$Common->getSessionKey()): ?>
						<li><a href="/<?php echo $grboard; ?>/blog/login" title="로그인">
							<span class="glyphicon glyphicon-ok"></span> Login</a></li>
						<?php else: ?>
						<li><a href="/<?php echo $grboard; ?>/blog/write" title="새 글 쓰기">
							<span class="glyphicon glyphicon-pencil"></span> Write</a></li>
						<li><a href="/<?php echo $grboard; ?>/blog/logout" title="로그아웃">
							<span class="glyphicon glyphicon-off"></span> Logout</a></li>
						<li><a href="/<?php echo $grboard; ?>/blog/admin" title="설정 화면">
							<span class="glyphicon glyphicon-cog"></span> Admin</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>	
	
		<div class="container">