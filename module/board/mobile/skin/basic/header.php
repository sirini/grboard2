<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $boardInfo['name']; ?></title>
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen" />
		<link href="<?php echo $skinResourcePath; ?>/style.css" rel="stylesheet" media="screen" />
		<script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo $skinResourcePath; ?>/<?php echo $mobileAction; ?>.skin.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>"><span class="glyphicon glyphicon-home"></span></a>					
				</div>
				
				<div class="collapse navbar-collapse">
				    <ul class="nav navbar-nav">
						<li><a href="<?php echo $boardLink; ?>/mobile/write/0"><span class="glyphicon glyphicon-pencil"></span> Write</a></li>
						<?php if(!$isMember): ?>
							<li><a href="<?php echo $boardLink; ?>/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
							<li><a href="<?php echo $boardLink; ?>/join"><span class="glyphicon glyphicon-user"></span> Join</a></li>
						<?php else: ?>
							<li><a href="<?php echo $boardLink; ?>/memo"><span class="glyphicon glyphicon-envelope"></span> Message</a></li>
							<li><a href="<?php echo $boardLink; ?>/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						<?php endif; ?>
							<li><a href="<?php echo $boardLink; ?>/mobile/list/1"><span class="glyphicon glyphicon-list-alt"></span> List</a></li>
						<?php if($isAdmin): ?>
							<li><a href="#managePostForm" id="managePosts">
								<span class="glyphicon glyphicon-trash"></span> Posts</a>
							</li>
							<li><a href="/<?php echo $grboard; ?>/board/admin/modify2board/<?php echo $boardInfo['no']; ?>">
								<span class="glyphicon glyphicon-cog"></span> Board</a>
							</li>
						<?php endif; ?>
					</ul>
					<form id="gr2searchForm" method="get" action="mobile/" class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="hidden" name="boardId" value="<?php echo $ext_id; ?>" />
							<input type="hidden" name="page" value="<?php echo $ext_page; ?>" />
							<select name="option">
								<option value="subject" <?php echo (isset($option) && $option == 'subject')?'selected="true"':''; ?>>Subject</option>
								<option value="content" <?php echo (isset($option) && $option == 'content')?'selected="true"':''; ?>>Content</option>
								<option value="tag" <?php echo (isset($option) && $option == 'tag')?'selected="true"':''; ?>>Tag</option>
								<option value="name" <?php echo (isset($option) && $option == 'name')?'selected="true"':''; ?>>Name</option>
							</select>
							<input type="search" name="value" value="<?php echo (isset($value)) ? $value:''; ?>" placeholder="search for..." class="form-control gr-inline" aria-label="...">
							<button class="btn btn-default" type="submit">Find</button>
						</div>
					</form>
				</div>
				
			</div>
		</nav>	
		
		<div class="container">	
			
		<ol class="breadcrumb">
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>">Home</a></li>
			<li><a href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/mobile/list/1"><?php echo $boardInfo['name']; ?></a></li>
			<?php if(isset($boardCategory[0])): ?>
			<li>
				<div class="dropdown gr-inline">
					<button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
					Category <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<?php foreach($boardCategory as &$category): ?>
						<li role="presentation">
							<a role="menuitem" tabindex="-1" 
							href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/mobile/category/:<?php echo $category; ?>/1">
							<?php echo $category; ?></a>
						</li>
					<?php endforeach; unset($category); ?>	
					</ul>
				</div>
			</li>
			<?php endif; ?>
		</ol>
