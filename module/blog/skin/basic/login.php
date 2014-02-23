<?php if(!defined('GR_BOARD_2')) exit(); ?>

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
						</li>
						<li><a href="/<?php echo $grboard; ?>/blog/guestbook"> 
							<span class="glyphicon glyphicon-comment"></span> Guestbook</a></li>
					</ul>
				</div>
			</div>
		</nav>	
	
		<div class="container">

		<form id="boardLoginForm" method="post" action="/<?php echo $grboard; ?>/blog/login" class="form-signin" role="form">
			<div class="hiddenInputs">
				<input type="hidden" name="loginProceed" value="true" />
			</div>
			<h2 class="form-signin-heading">Please sign in</h2>
			<input type="text" id="userid" name="userid" class="form-control" placeholder="아이디를 입력해 주세요" required="true" autofocus="true" />
			<input type="password" id="passwd" name="passwd" class="form-control" placeholder="비밀번호를 입력해 주세요" required="true" />
			<input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in" />
		</form>
