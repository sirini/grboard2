<?php include 'model.php'; ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>GR Board 2 Manually Update</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="../lib/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen" />
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
					<li class="active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" title="<?php echo $lang['tooltip_go_first_page'] ?>">
						<span class="glyphicon glyphicon-home"></span> Home</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://sirini.net" title="Powered by GR Board 2 | sirini.net"> 
						<span class="glyphicon glyphicon-link"></span> GR Board <sup>2</sup></a></li>
				</ul>
			</div>
		</div>
	</nav>	
	
	<div class="container">
		<div class="well"><?php echo $lang['msg_success']; ?></div>
	</div>
	
	</body>
</html>