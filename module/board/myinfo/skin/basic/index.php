<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>My Information</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/material.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/ripples.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/roboto.min.css" rel="stylesheet" media="screen" />
		<script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap/js/bootstrap.min.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/material.min.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/ripples.min.js"></script>
		<script src="<?php echo $skinResourcePath; ?>/join.js"></script>
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
					<li><a href="#" title="Powered by GR Board 2 | grboard.com"> 
						<span class="glyphicon glyphicon-link"></span> GR Board <sup>2</sup></a></li>
				</ul>
			</div>
		</div>
	</nav>	
	
	<div id="gr2MyInfoPageBody" class="container" rel="<?php echo $grboard; ?>">
		<div class="panel panel-default">
			<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <strong>My Information</strong></div>
			<div class="panel-body">
				<form id="boardMyInfoForm" method="post" action="<?php echo $prePath; ?>/myinfo" class="form-horizontal">
					<div class="hiddenInputs">
						<input type="hidden" name="updateMyInfoProceed" value"true" />
						<input type="hidden" name="photo" value="" />
						<input type="hidden" name="nametag" value="" />
						<input type="hidden" name="icon" value="" />
					</div>
					<fieldset>
						<div class="form-group">
							<label class="col-md-2 control-label" for="userId">ID</label>		
							<div class="col-md-3">
								<input id="userId" name="userId" type="text" class="form-control input-md" value="<?php echo $myinfo['id']; ?>" readonly="true" />
							</div>
							<span id="userIdInfo" class="col-md-7 help-block">ID 는 변경이 불가능 합니다</span>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="userPw">Password</label>
							<div class="col-md-3">
								<input id="userPw" name="userPw" type="password" placeholder="여기에 비밀번호를 입력해 주세요" class="form-control input-md" />
							</div>
							<span id="userPwInfo" class="col-md-7 help-block">입력할 경우 새로 입력된 비밀번호로 변경 됩니다</span>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="userNick">Nickname</label>		
							<div class="col-md-3">
								<input id="userNick" name="userNick" type="text" placeholder="여기에 닉네임을 입력해 주세요" required="true" value="<?php echo $myinfo['nickname']; ?>" class="form-control input-md" />
							</div>
							<span class="col-md-7 help-block">한글, 영문, 숫자, 특문 사용 가능</span>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="userReal">Realname</label>		
							<div class="col-md-3">
								<input id="userReal" name="userReal" type="text" placeholder="여기에 본명(실명)을 입력해 주세요" required="true" value="<?php echo $myinfo['realname']; ?>"  class="form-control input-md" />
							</div>
							<span id="userRealInfo" class="col-md-7 help-block">본명을 입력해 주세요</span>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="userEmail">E-mail</label>		
							<div class="col-md-3">
								<input id="userEmail" name="userEmail" type="email" placeholder="(선택) 여기에 이메일 주소를 입력해 주세요" value="<?php echo $myinfo['email']; ?>" class="form-control input-md" />
							</div>
							<span class="col-md-7 help-block">이메일 주소를 입력해 주세요 (선택사항)</span>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="userHome">Homepage</label>		
							<div class="col-md-3">
								<input id="userHome" name="userHome" type="url" placeholder="(선택) 여기에 홈페이지/블로그/페북/트위터 주소를 입력해 주세요" value="<?php echo $myinfo['homepage']; ?>" class="form-control input-md" />
							</div>
							<span class="col-md-7 help-block">홈페이지/블로그/페북/트위터 주소를 입력해 주세요 (선택사항)</span>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="userIntro">Introduce</label>		
							<div class="col-md-3">
								<textarea id="userIntro" name="userIntro" placeholder="(선택) 여기에 본인 소개글을 입력해 주세요" class="form-control textarea-md" rows="5">
									<?php echo $myinfo['self_info']; ?>
								</textarea>
							</div>
							<span class="col-md-7 help-block">본인 소개글은 250자 이내로 HTML 태그 없이 해주세요 (선택사항)</span>
						</div>
						
						<div class="form-group">
							<div class="col-md-12 text-right">
								<input type="submit" class="btn btn-lg btn-primary" role="button" value="Update my information" />
							</div>
						</div>
						
					</fieldset>
								
				</form>
			</div>
		</div>
	</div>
	
	</body>
</html>