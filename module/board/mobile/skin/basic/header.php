<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<title><?php echo $boardInfo['name']; ?></title>
		<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
	    <script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
    	<script src="/<?php echo $grboard; ?>/lib/popper.js"></script>
		<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/bootstrap-material-design.min.js"></script>	
		<script src="<?php echo $skinResourcePath; ?>/<?php echo $mobileAction; ?>.skin.js"></script>
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
		
		<div id="grboard2TopNav" class="navbar-collapse collapse justify-content-between">
			<ul class="navbar-nav">
				<li class="nav-item active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" data-toggle="tooltip" class="nav-link">
					Home <span class="sr-only">(current)</span></a></li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navDropdownMenus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MENU</a>
					<div class="dropdown-menu" aria-labelledby="navDropdownMenus">
        				<a class="dropdown-item" href="<?php echo $boardLink; ?>/write/0">Write</a>
        				<?php if(isset($boardPost['member_key']) && isPermitted($boardPost['member_key'], $Common->getSessionKey())): ?>
        				<a class="dropdown-item" href="<?php echo $boardLink; ?>/write/<?php echo $boardPost['no']; ?>">Modify</a>
        				<a class="dropdown-item" href="<?php echo $boardLink; ?>/deletepost/<?php echo $boardPost['no']; ?>">Delete</a>
        				<?php endif; 
        				if(!$isMember): ?>
        				<a class="dropdown-item" href="<?php echo $boardLink; ?>/login/0">Login</a>
        				<a class="dropdown-item" href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/join">Join</a>
        				<?php else: ?>
        				<a class="dropdown-item" href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/memo">Message</a>
        				<a class="dropdown-item" href="<?php echo $boardLink; ?>/logout/0">Logout</a>
        				<?php endif; ?>
        				<a class="dropdown-item" href="<?php echo $boardLink; ?>/list/1">List</a>
        				<a class="dropdown-item" href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/list/<?php echo $ext_page; ?>">PC view</a>
        			</div>
				</li>
			</ul>
			
	        <form id="gr2searchForm" method="get" action="mobile/" class="form-inline" role="search">
				<div class="form-group">
					<input type="hidden" name="boardId" value="<?php echo $ext_id; ?>" />
					<input type="hidden" name="page" value="<?php echo $ext_page; ?>" />
					<select name="option" class="custom-select">
						<option value="subject" <?php echo (isset($option) && $option == 'subject')?'selected="true"':''; ?>>Subject</option>
						<option value="content" <?php echo (isset($option) && $option == 'content')?'selected="true"':''; ?>>Content</option>
						<option value="tag" <?php echo (isset($option) && $option == 'tag')?'selected="true"':''; ?>>Tag</option>
						<option value="name" <?php echo (isset($option) && $option == 'name')?'selected="true"':''; ?>>Name</option>
					</select>
					<input type="search" name="value" value="<?php echo (isset($value)) ? $value:''; ?>" placeholder="search for..." class="form-control mr-sm-2" aria-label="...">
					<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="submit" />
				</div>
			</form>

		</div>
	</nav>	
		
	<div class="container"><!-- #start container (#end is in footer.php file) -->	
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>">Home</a></li>
			<li class="breadcrumb-item active"><a href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/mobile/list/1"><?php echo $boardInfo['name']; ?></a></li>
			<?php if(isset($boardCategory[0])): ?>
			<li class="breadcrumb-item active">
		
				<a href="#" class="dropdown-toggle" id="navCategoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CATEGORY</a>
				<div class="dropdown-menu" aria-labelledby="navCategoryDropdown">
					<?php foreach($boardCategory as &$category): ?>
					<a class="dropdown-item" role="menuitem" tabindex="-1" 
						href="/<?php echo $grboard; ?>/board-<?php echo $ext_id; ?>/mobile/category/:<?php echo $category; ?>/1"><?php echo $category; ?></a>
					<?php endforeach; unset($category); ?>	
				</div>
			</li>
			<?php endif; ?>
		</ol>
