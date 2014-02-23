<?php 
if(!defined('GR_BOARD_2')) exit(); 

include 'lang.korean.php';
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>GR Board 2 Installation</title>
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
					<li class="active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" title="<?php echo $lang['home_info']; ?>">
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
	
		<form role="form" class="form-horizontal" method="post" action="/<?php echo $grboard; ?>/install/save.php">
		<fieldset>
			<legend>GR Board <sup>2</sup> Installation</legend>
			
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Warning!</strong> <?php echo $lang['install_warning']; ?>
			</div>
			
			<div class="well">
				<p><?php echo $lang['install_welcome']; ?></p>
				<p><?php echo $lang['install_feature']; ?></p>
				<p><?php echo $lang['install_license']; ?></p>
				<p><?php echo $lang['install_notice']; ?></p>
			</div>
			
			<div class="form-group">
				<label for="name" class="col-md-2 control-label">DB Type</label>
				<div class="col-md-3">
					<select name="db_type" class="form-control">
						<option value="mysql">MySQL 5</option>
					</select>
				</div>
				<span class="help-block col-md-7"><?php echo $lang['install_db_type']; ?></span>
			</div>	
			
			<div class="form-group">
				<label for="db_hostname" class="col-md-2 control-label">Hostname</label>
				<div class="col-md-3">
					<input type="text" name="db_hostname" required="true" class="form-control" maxlength="20" value="localhost" /> 
				</div>
				<span class="help-block col-md-7"><?php echo $lang['install_hostname']; ?></span>
			</div>	
			
			<div class="form-group">
				<label for="db_username" class="col-md-2 control-label">DB user name</label>
				<div class="col-md-3">
					<input type="text" name="db_username" placeholder="DB 계정 아이디 입력" required="true" class="form-control" maxlength="20" value="" /> 
				</div>
				<span class="help-block col-md-7"><?php echo $lang['install_dbusername']; ?></span>
			</div>
			
			<div class="form-group">
				<label for="db_password" class="col-md-2 control-label">DB user password</label>
				<div class="col-md-3">
					<input type="password" name="db_password" placeholder="DB 계정 비밀번호 입력" required="true" class="form-control" maxlength="20" value="" /> 
				</div>
				<span class="help-block col-md-7"><?php echo $lang['install_dbpasswd']; ?></span>
			</div>	
			
			<div class="form-group">
				<label for="db_dbname" class="col-md-2 control-label">DB name</label>
				<div class="col-md-3">
					<input type="text" name="db_dbname" placeholder="사용할 DB 이름 입력" required="true" class="form-control" maxlength="20" value="" /> 
				</div>
				<span class="help-block col-md-7"><?php echo $lang['install_dbname']; ?></span>
			</div>		
			
			<div class="form-group">
				<label for="db_prefix_board" class="col-md-2 control-label">DB table prefix</label>
				<div class="col-md-2">
					<input type="text" name="db_prefix_board" required="true" class="form-control" maxlength="20" value="gr_" /> 
				</div>
				<div class="col-md-2">
					<input type="text" name="db_prefix_blog" required="true" class="form-control" maxlength="20" value="gbl_" /> 
				</div>
				<span class="help-block col-md-6"><?php echo $lang['install_dbprefix']; ?></span>
			</div>	
			
			<div class="form-group">
				<label for="admin_id" class="col-md-2 control-label">Administrator</label>
				<div class="col-md-2">
					<input type="text" name="admin_id" placeholder="관리자 ID 지정" required="true" class="form-control" maxlength="20" value="admin" /> 
				</div>
				<div class="col-md-2">
					<input type="password" name="admin_pw" placeholder="관리자 비밀번호 지정" required="true" class="form-control" maxlength="20" value="" /> 
				</div>
				<span class="help-block col-md-6"><?php echo $lang['install_admin_info']; ?></span>
			</div>	
			
			<div class="form-group text-right">
				<input type="submit" value="Submit" class="btn btn-lg btn-primary" />
			</div>
			
		</fieldset>
		</form>

	</div>
	
	<script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap/js/bootstrap.min.js"></script>
	
	</body>
</html>