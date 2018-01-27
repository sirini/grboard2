<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Message Box | 쪽지함</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

	    <script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
    	<script src="/<?php echo $grboard; ?>/lib/popper.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/bootstrap-material-design.min.js"></script>
		<script src="<?php echo $skinResourcePath; ?>/memo.js"></script>
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
				<li class="nav-item"><a href="<?php echo $moveBackPath; ?>" class="nav-link" data-toggle="tooltip" title="이전 화면으로 이동 합니다">
					Back</a></li>
				<li class="nav-item"><a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
					GR Board <sup>2</sup></a></li>
			</ul>
		</div>
	</nav>			
	
	<div id="memoBox" role="<?php echo $ext_id; ?>" class="container">
    	<div id="gr2memoPageBody" class="card bg-light" rel="<?php echo $grboard; ?>" 
    		data-push-userkey="<?php echo $Model->getUserId($Common->getSessionKey()); ?>"
    		data-push-roomid="<?php echo $_SERVER['HTTP_HOST']; ?>">
    		<?php include $mode . '.php'; ?>
    	</div>
	</div>
	
	</body>
</html>