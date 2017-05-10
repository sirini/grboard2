<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $blogInfo['blog_title']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $skinResourcePath; ?>/skin.css" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/material.min.css" rel="stylesheet" media="screen" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/ripples.min.css" rel="stylesheet" media="screen" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/roboto.min.css" rel="stylesheet" media="screen" />
	<link type="text/css" rel="stylesheet" href="/<?php echo $grboard; ?>/lib/syntaxhighlighter/styles/shCore.css">
	<link type="text/css" rel="stylesheet" href="/<?php echo $grboard; ?>/lib/syntaxhighlighter/styles/shThemeDefault.css">
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shCore.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shLegacy.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushBash.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushCpp.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushCSharp.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushCss.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushDiff.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushJava.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushJScript.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushPhp.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushPlain.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushPython.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushSql.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/syntaxhighlighter/scripts/shBrushXml.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/material.min.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/ripples.min.js"></script>
	<script src="<?php echo $skinResourcePath . '/' . $ext_action; ?>.skin.js"></script>
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
						
					<form id="blogSearchForm" class="navbar-form navbar-right" method="post" action="/" rel="<?php echo $grboard; ?>">
						<div class="form-group is-empty">
							<input id="blogSearchText" type="text" class="form-control col-md-8" placeholder="Search">
							<span class="material-input"></span>
						</div>
					</form>
				</div>
			</div>
		</nav>	
	
		<div class="container">