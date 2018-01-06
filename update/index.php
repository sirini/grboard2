<?php include 'model.php'; ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>GR Board 2 Manually Update</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="../lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
	    <script src="../lib/jquery.js"></script>
    	<script src="../lib/popper.js"></script>
		<script src="../lib/bootstrap_material_design/js/bootstrap-material-design.min.js">   </script>
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

		<div class="card">
			<div class="card-body">
				<h4 class="card-title">GR Board <sup>2</sup> Update Page</h4>

				<p class="card-text">
					<?php echo $lang['msg_success']; ?>
				</p>
			</div>
		</div>

	</div>
	
	</body>
</html>