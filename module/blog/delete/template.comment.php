<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>GR Board 2</title>
	<style type="text/css">
	.red { 
		font-family: 돋움, sans-serif; 
		font-size: 1.2em; 
		color: red; 
		text-decoration: none; 
		letter-spacing: 4px; 
		font-weight: bold;
	}
	.green { 
		font-family: 돋움, sans-serif; 
		font-size: 1.2em; 
		color: green; 
		text-decoration: none; 
		letter-spacing: 4px; 
		font-weight: bold;
	}
	</style>
</head>
<body>
	<h2>정말로 해당 글을 삭제하시겠습니까?</h2>
	<a href="/<?php echo $grboard; ?>/blog/delete/comment/<?php echo (int)$_GET['comment']; ?>" class="red">삭제 진행!</a> &nbsp;|&nbsp;
	<a href="/<?php echo $grboard; ?>/blog/view/<?php echo $postUID; ?>" class="green">삭제 취소!</a>
</body>
</html>