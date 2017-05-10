<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sign in</title>		
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
		<link href="<?php echo $skinResourcePath; ?>/login.css" rel="stylesheet" media="screen" />

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
				<li class="nav-item active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" data-toggle="tooltip" title="<?php echo $lang['home_info']; ?>" class="nav-link">
					Home <span class="sr-only">(current)</span></a></li>
				<li class="nav-item"><a href="<?php echo $moveBackPath; ?>" data-toggle="tooltip" title="이전 화면으로 돌아갑니다" class="nav-link"> 
					Back</a></li>	
				<li class="nav-item"><a href="<?php echo $prePath; ?>/join/0" data-toggle="tooltip" title="계정이 없을 경우 여기를 클릭하여 회원 가입을 하실 수 있습니다" class="nav-link"> 
					Join</a></li>	
				<li class="nav-item"><a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
					GR Board <sup>2</sup></a></li>
			</ul>
		</div>
	</nav>	
		
	<div class="container">
		<form id="boardLoginForm" method="post" action="<?php echo $prePath; ?>/login/0" class="form-signin" role="form">
			<div class="card">
				<div class="card-header">
					Login
				</div>
				<div class="card-body">
					<div class="hiddenInputs">
						<input type="hidden" name="loginProceed" value="true" />
					</div>
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
			</div>
		</form>
	</div>
	
	</body>
</html>