<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Error</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen" />
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
					<li class="active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" title="첫 화면으로 이동 합니다">
						<span class="glyphicon glyphicon-home"></span> Home</a></li>
					<li><a href="<?php echo $moveBackPath; ?>" title="이전 화면으로 이동 합니다">
						<span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" title="Powered by GR Board 2 | sirini.net"> 
						<span class="glyphicon glyphicon-link"></span> GR Board <sup>2</sup></a></li>
				</ul>
			</div>
		</div>
	</nav>	
	
	<div class="container">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Error</h3>
			</div>
			<div class="panel-body">
				<?php echo $msg; ?>
			</div>
			<div class="panel-footer">
				<a href="<?php echo $moveBackPath; ?>" title="이전 화면으로 이동 합니다">
					<span class="glyphicon glyphicon-arrow-left"></span> Move back</a>
			</div>
		</div>
	</div>
	
	<script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap/js/bootstrap.min.js"></script>
	
	</body>
</html>