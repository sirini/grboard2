<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Join us | 회원 가입하기</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

	    <script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
    	<script src="/<?php echo $grboard; ?>/lib/popper.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/bootstrap-material-design.min.js"></script>
		<script src="<?php echo $skinResourcePath; ?>/join.js"></script>
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
					Home</a></li>
				<li class="nav-item"><a href="<?php echo $moveBackPath; ?>" class="nav-link" data-toggle="tooltip" title="이전 화면으로 이동 합니다">
					Back</a></li>
				<li class="nav-item"><a href="<?php echo $prePath; ?>/login" class="nav-link" data-toggle="tooltip" title="이미 계정이 있으시다면 여기를 클릭 하여 로그인 하실 수 있습니다"> 
					Login</a></li>
				<li class="nav-item"><a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
					GR Board <sup>2</sup></a></li>
			</ul>
		</div>
	</nav>		
	
	
	<div id="gr2joinPageBody" class="container" rel="<?php echo $grboard; ?>">
		<div class="card bg-light">
			<h4 class="card-header">회원 가입하기</h4>
			<div class="card-body">
				<form id="boardJoinForm" method="post" action="<?php echo $prePath; ?>/join" class="form-horizontal">
					<div class="hiddenInputs">
						<input type="hidden" name="joinProceed" value="true" />
						<input type="hidden" name="photo" value="" />
						<input type="hidden" name="nametag" value="" />
						<input type="hidden" name="icon" value="" />
					</div>
					
					<div class="row">
						<div class="col">
    						<div class="form-group">
    							<label class="control-label" for="userId">ID</label>
    							<input id="userId" name="userId" type="text" placeholder="여기에 아이디를 입력해 주세요" aria-describeby="userIdInfo" required="true" autofocus="true" class="form-control" />
    							<small id="userIdInfo" class="form-text text-muted">영문, 숫자, _ (밑줄) 등의 문자 사용 가능</small>
    						</div>
    						
    						<div class="form-group">
    							<label class="control-label" for="userNick">Nickname</label>
    							<input id="userNick" name="userNick" type="text" placeholder="여기에 별명을 입력해 주세요" aria-describeby="userNickInfo" required="true" autofocus="true" class="form-control" />
    							<small id="userNickInfo" class="form-text text-muted">영문, 숫자, _ (밑줄) 등의 문자 사용 가능</small>
    						</div>
    						
    						<div class="form-group">
    							<label class="control-label" for="userEmail">E-mail</label>
    							<input id="userEmail" name="userEmail" type="email" placeholder="(선택) 여기에 이메일 주소를 입력해 주세요" aria-describeby="userEmailInfo" autofocus="true" class="form-control" />
    							<small id="userEmailInfo" class="form-text text-muted">(선택) 이메일 주소를 입력해 주세요</small>
    						</div>    						
						</div>
						<div class="col">
    						<div class="form-group">
    							<label class="control-label" for="userPw">Password</label>
    							<input id="userPw" name="userPw" type="password" placeholder="여기에 사용하실 비밀번호를 입력해 주세요" aria-describeby="userPwInfo" required="true" autofocus="true" class="form-control" />
    							<small id="userPwInfo" class="form-text text-muted">영문, 숫자, 특수문자 등을 혼합해 주세요</small>
    						</div>
    						
    						<div class="form-group">
    							<label class="control-label" for="userReal">Realname</label>
    							<input id="userReal" name="userReal" type="text" placeholder="여기에 본명(실명)을 입력해 주세요" aria-describeby="userRealInfo" required="true" autofocus="true" class="form-control" />
    							<small id="userRealInfo" class="form-text text-muted">여기에는 본명(실명)을 입력해 주세요</small>
    						</div>
    						
    						<div class="form-group">
    							<label class="control-label" for="userHome">Homepage</label>
    							<input id="userHome" name="userHome" type="url" placeholder="(선택) 여기에 본인의 SNS 주소를 입력해 주세요" aria-describeby="userHomeInfo" autofocus="true" class="form-control" />
    							<small id="userHomeInfo" class="form-text text-muted">(선택) 홈페이지/블로그/페북/트위터 주소를 입력해 주세요</small>
    						</div>    						
						</div>
					</div>
					
            		<!-- for Google reCAPTCHA | Please update your google reCAPTCHA sitekey/secretkey in common.config.php -->
            		<div class="form-group">			
            			<script src='<?php echo $gr2cfg['googleRecaptchaApiUrl']; ?>'></script>
            			<div class="g-recaptcha" data-sitekey="<?php echo $gr2cfg['googleRecaptchaSiteKey']; ?>"></div>
            		</div>
						
					<div class="form-group">
						<label class="control-label" for="userIntro">Introduce</label>
						<textarea id="userIntro" name="userIntro" placeholder="(선택) 여기에 본인 소개글을 입력해 주세요" class="form-control" rows="5"></textarea>
						<small class="form-text text-muted">(선택) 본인 소개글은 250자 이내로 HTML 태그 없이 해주세요</small>
					</div>
						
					<div class="form-group">
						<input type="submit" class="btn btn-lg btn-primary btn-block" data-toggle="tooltip" title="" role="button" value="Join now" />
					</div>
						
								
				</form>
			</div>
		</div>
	</div>
	
	</body>
</html>