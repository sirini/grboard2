<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Join us</title>
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
					<li><a href="<?php echo $prePath; ?>/login" title="이미 계정이 있으시다면 여기를 클릭 하여 로그인 하실 수 있습니다"> 
						<span class="glyphicon glyphicon-ok"></span> Login</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" title="Powered by GR Board 2 | sirini.net"> 
						<span class="glyphicon glyphicon-link"></span> GR Board <sup>2</sup></a></li>
				</ul>
			</div>
		</div>
	</nav>	
	
	<div id="gr2joinPageBody" class="container" rel="<?php echo $grboard; ?>">
		<form id="boardJoinForm" method="post" action="<?php echo $prePath; ?>/join" class="form-horizontal">
			<div class="hiddenInputs">
				<input type="hidden" name="joinProceed" value"true" />
				<input type="hidden" name="photo" value="" />
				<input type="hidden" name="nametag" value="" />
				<input type="hidden" name="icon" value="" />
			</div>
			<fieldset>
				<legend><span class="glyphicon glyphicon-user"></span> Join us</legend>
				<div class="form-group">
					<label class="col-md-2 control-label" for="userId"><span class="glyphicon glyphicon-asterisk"></span> ID</label>		
					<div class="col-md-3">
						<input id="userId" name="userId" type="text" placeholder="여기에 아이디를 입력해 주세요" required="true" autofocus="true" class="form-control input-md" />
					</div>
					<span id="userIdInfo" class="col-md-7 help-block">영문, 숫자, _ (밑줄) 등의 문자 사용 가능</span>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label" for="userPw"><span class="glyphicon glyphicon-asterisk"></span> Password</label>
					<div class="col-md-3">
						<input id="userPw" name="userPw" type="password" placeholder="여기에 비밀번호를 입력해 주세요" required="true" class="form-control input-md" />
					</div>
					<span id="userPwInfo" class="col-md-7 help-block">영문, 숫자, 특수기호 등 조합 필요</span>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label" for="userNick"><span class="glyphicon glyphicon-asterisk"></span> Nickname</label>		
					<div class="col-md-3">
						<input id="userNick" name="userNick" type="text" placeholder="여기에 닉네임을 입력해 주세요" required="true" class="form-control input-md" />
					</div>
					<span class="col-md-7 help-block">한글, 영문, 숫자, 특문 사용 가능</span>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label" for="userReal"><span class="glyphicon glyphicon-asterisk"></span> Realname</label>		
					<div class="col-md-3">
						<input id="userReal" name="userReal" type="text" placeholder="여기에 본명(실명)을 입력해 주세요" required="true" class="form-control input-md" />
					</div>
					<span id="userRealInfo" class="col-md-7 help-block">본명을 입력해 주세요</span>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label" for="userEmail">E-mail</label>		
					<div class="col-md-3">
						<input id="userEmail" name="userEmail" type="email" placeholder="(선택) 여기에 이메일 주소를 입력해 주세요" class="form-control input-md" />
					</div>
					<span class="col-md-7 help-block">이메일 주소를 입력해 주세요 (선택사항)</span>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label" for="userHome">Homepage</label>		
					<div class="col-md-3">
						<input id="userHome" name="userHome" type="url" placeholder="(선택) 여기에 홈페이지/블로그/페북/트위터 주소를 입력해 주세요" class="form-control input-md" />
					</div>
					<span class="col-md-7 help-block">홈페이지/블로그/페북/트위터 주소를 입력해 주세요 (선택사항)</span>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label" for="userIntro">Introduce</label>		
					<div class="col-md-3">
						<textarea id="userIntro" name="userIntro" placeholder="(선택) 여기에 본인 소개글을 입력해 주세요" class="form-control textarea-md" rows="5"></textarea>
					</div>
					<span class="col-md-7 help-block">본인 소개글은 250자 이내로 HTML 태그 없이 해주세요 (선택사항)</span>
				</div>
				
			</fieldset>
			
			<div class="form-group text-right">
				<input type="submit" class="btn btn-lg btn-primary" role="button" value="Join now" />
			</div>
			
		</form>
	</div>
	
	<script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $skinResourcePath; ?>/join.js"></script>
	
	</body>
</html>