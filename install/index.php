<?php 
if(!defined('GR_BOARD_2')) exit(); 

include 'lang.korean.php';
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>GR Board 2 Installation</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

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
				<li class="nav-item"><a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
					GR Board <sup>2</sup></a></li>
			</ul>
		</div>
	</nav>	
	
	<div class="container">
	
		<form role="form" class="form-horizontal" method="post" action="/<?php echo $grboard; ?>/install/save.php">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">GR Board <sup>2</sup> Installation</h4>
			
				<div class="alert alert-warning alert-dismissable fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</button>
					<strong>Notice) </strong> <?php echo $lang['install_warning']; ?>
				</div>
			
				<?php
				$dirPerm = decoct(fileperms('../'.$grboard) - 16384);
				if($dirPerm != 777 && $dirPerm != 707) { 
				?>
				<div class="alert alert-danger fade show" role="alert">
					<strong>Warning!</strong> <?php echo $lang['install_warning_permission']; ?> (Permission: <?php echo $dirPerm; ?>)
				</div>
				<?php } ?>
			
				<p class="card-text">
					<p><?php echo $lang['install_welcome']; ?></p>
					<p><?php echo $lang['install_feature']; ?></p>
					<p><?php echo $lang['install_license']; ?></p>
					<p><?php echo $lang['install_notice']; ?></p>
				</p>
			</div>
		</div>
			
		<div>
			<div class="form-group">
				<label for="name" class="control-label">DB Type</label>
				<div class="row">
					<div class="col">
						<select name="db_type" class="form-control" aria-describedby="dbtypeHelp">
							<option value="mysql">MySQLi 5</option>
						</select>
					</div>
				</div>
				<small id="dbtypeHelp" class="form-text text-muted"><?php echo $lang['install_db_type']; ?></small>
			</div>	
			
			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="db_hostname" class="control-label">Hostname</label>
						<input type="text" id="db_hostname" name="db_hostname" required="true" aria-describedby="hostnameHelp" class="form-control" maxlength="100" value="localhost" /> 
						<small id="hostnameHelp" class="form-text text-muted"><?php echo $lang['install_hostname']; ?></small>
					</div>
					<div class="col">
						<label for="db_username" class="control-label">DB user name</label>
						<input type="text" id="db_username" name="db_username" placeholder="DB 계정 아이디 입력" aria-describedby="dbuserHelp" required="true" class="form-control" maxlength="100" value="" /> 
						<small id="dbuserHelp" class="form-text text-muted"><?php echo $lang['install_dbusername']; ?></small>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="db_password" class="control-label">DB user password</label>
						<input type="password" id="db_password" name="db_password" placeholder="DB 계정 비밀번호 입력" aria-describedby="dbpasswordHelp" required="true" class="form-control" maxlength="100" value="" /> 
						<small id="dbpasswordHelp" class="form-text text-muted"><?php echo $lang['install_dbpasswd']; ?></small>
					</div>
					
					<div class="col">
						<label for="db_dbname" class="control-label">DB name</label>
						<input type="text" id="db_dbname" name="db_dbname" placeholder="사용할 DB 이름 입력" aria-describedby="dbnameHelp" required="true" class="form-control" maxlength="100" value="" /> 
						<small id="dbnameHelp" class="form-text text-muted"><?php echo $lang['install_dbname']; ?></small>
					</div>
				</div>
			</div>		
			
			<div class="form-group">
				<label for="db_prefix_board" class="control-label">DB table prefix</label>
				<div class="row">
					<div class="col">
						<input type="text" id="db_prefix_board" name="db_prefix_board" aria-describedby="dbPrefixHelp" required="true" class="form-control" maxlength="100" value="gr_" /> 					
					</div>
					<div class="col">
						<input type="text" id="db_prefix_blog" name="db_prefix_blog" aria-describedby="dbPrefixHelp" required="true" class="form-control" maxlength="100" value="gbl_" /> 
					</div>
				</div>
				<small id="dbPrefixHelp" class="help-block"><?php echo $lang['install_dbprefix']; ?></small>
			</div>	

			<div class="form-group">
				<label for="google_recaptcha_sitekey_id" class="control-label">Google reCAPTCHA <a href="https://www.google.com/recaptcha" title="비회원이 글이나 댓글을 작성할 땐 구글의 reCAPTCHA 테스트를 통과해야 합니다. 여기에서 더 알아보세요!">[site]</a></label>

				<div class="row">
					<div class="col">
						<input type="text" id="google_recaptcha_sitekey_id" name="google_recaptcha_sitekey_id" placeholder="Google reCAPTCHA Site Key 등록" aria-describedby="recaptchaInfoHelp" class="form-control" maxlength="200" /> 
					</div>
					<div class="col">
						<input type="text" id="google_recaptcha_secretkey_id" name="google_recaptcha_secretkey_id" placeholder="Google reCAPTCHA Secret Key 등록" aria-describedby="recaptchaInfoHelp" class="form-control" maxlength="200" /> 
					</div>
				</div>
				<small id="recaptchaInfoHelp" class="help-block"><?php echo $lang['install_recaptcha_info']; ?></small>
			</div>	
			
			<div class="form-group">
				<label for="admin_id" class="control-label">Administrator</label>

				<div class="row">
					<div class="col">
						<input type="text" id="admin_id" name="admin_id" placeholder="관리자 ID 지정" aria-describedby="adminInfoHelp" required="true" class="form-control" maxlength="100" value="admin" /> 
					</div>
					<div class="col">
						<input type="password" id="admin_pw" name="admin_pw" placeholder="관리자 비밀번호 지정" aria-describedby="adminInfoHelp" required="true" class="form-control" maxlength="100" value="" /> 
					</div>
				</div>
				<small id="adminInfoHelp" class="help-block"><?php echo $lang['install_admin_info']; ?></small>
			</div>	
			
			<div class="form-group text-right">
				<div class="row">
					<div class="col">
						<input type="submit" value="Submit" class="btn btn-lg btn-primary btn-raised" />
					</div>
				</div>
			</div>
			
		</div>
		</form>

	</div>
	
	</body>
</html>