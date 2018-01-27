<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>My Information | 내 정보</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

	    <script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
    	<script src="/<?php echo $grboard; ?>/lib/popper.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/bootstrap-material-design.min.js"></script>
		<script src="<?php echo $skinResourcePath; ?>/myinfo.js"></script>
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
				<li class="nav-item"><a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
					GR Board <sup>2</sup></a></li>
			</ul>
		</div>
	</nav>			
	
	<div id="gr2MyInfoPageBody" class="container" rel="<?php echo $grboard; ?>">
		<div class="card bg-light">
			<h4 class="card-header">My Information</h4>
			<div class="card-body">
				<form id="boardMyInfoForm" method="post" action="<?php echo $prePath; ?>/myinfo" class="form-horizontal">
					<div class="hiddenInputs">
						<input type="hidden" name="updateMyInfoProceed" value="true" />
						<input type="hidden" name="photo" value="" />
						<input type="hidden" name="nametag" value="" />
						<input type="hidden" name="icon" value="" />
					</div>
					
					<div class="row">
						<div class="col">
    						<div class="form-group">
    							<label class="control-label" for="userId">ID</label>
    							<input id="userId" name="userId" type="text" class="form-control input-md" value="<?php echo $myinfo['id']; ?>" readonly="true" data-toggle="tooltip" title="ID는 변경 하실 수 없습니다" />
    							<small id="userIdInfo" class="form-text text-muted">ID 는 변경이 불가능 합니다</small>
    						</div>
    						<div class="form-group">
    							<label class="control-label" for="userNick">Nickname</label>
    							<input id="userNick" name="userNick" type="text" data-toggle="tooltip" title="다른 사용자에게 불쾌감을 주는 별명 사용은 금지 됩니다" required="true" value="<?php echo $myinfo['nickname']; ?>" class="form-control" />
    							<small class="form-text text-muted">한글, 영문, 숫자, 특문 사용 가능</small>
    						</div>
    						<div class="form-group">
    							<label class="control-label" for="userEmail">E-mail</label>
    							<input id="userEmail" name="userEmail" type="email" placeholder="(선택) 여기에 이메일 주소를 입력해 주세요" value="<?php echo $myinfo['email']; ?>" class="form-control input-md" />
    							<small class="form-text text-muted">(선택) 이메일 주소를 입력해 주세요</small>
    						</div>
						</div>
						<div class="col">						
    						<div class="form-group">
    							<label class="control-label" for="userPw">Change Password</label>
    							<input id="userPw" name="userPw" type="password" data-toggle="tooltip" title="비밀 번호를 변경 하고자 하실 경우 이 곳에 입력해 주세요" class="form-control" />
    							<small id="userPwInfo" class="form-text text-muted">입력할 경우 새로 입력된 비밀번호로 변경 됩니다</small>
    						</div>
    						<div class="form-group">
    							<label class="control-label" for="userReal">Realname</label>
    							<input id="userReal" name="userReal" type="text" required="true" value="<?php echo $myinfo['realname']; ?>"  class="form-control" />
    							<small id="userRealInfo" class="form-text text-muted">본명을 입력해 주세요</small>
    						</div>
    						<div class="form-group">
    							<label class="control-label" for="userHome">Homepage</label>
    							<input id="userHome" name="userHome" type="url" placeholder="(선택) 여기에 홈페이지/블로그/페북/트위터 주소를 입력해 주세요" value="<?php echo $myinfo['homepage']; ?>" class="form-control" />
    							<small class="form-text text-muted">(선택) 본인의 SNS 주소를 입력해 주세요</small>
    						</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label" for="userIntro">Introduce</label>
						<textarea id="userIntro" name="userIntro" placeholder="(선택) 여기에 본인 소개글을 입력해 주세요" class="form-control" rows="5"><?php echo $myinfo['self_info']; ?></textarea>
						<small class="form-text text-muted">본인 소개글은 250자 이내로 HTML 태그 없이 해주세요 (선택사항)</small>
					</div>
					
					<div class="form-group">
						<input type="submit" class="btn btn-lg btn-primary btn-block" role="button" value="Update" />
					</div>						
								
				</form>
			</div>
		</div>
	</div>
	
	</body>
</html>