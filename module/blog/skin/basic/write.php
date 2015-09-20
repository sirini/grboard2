<?php 
if(!defined('GR_BOARD_2')) exit(); 
if( $Common->getSessionKey() != 1 ): 
	$Common->error($error['msg_no_permission'], '/' . $grboard . '/blog');
endif;

if(!isset($blogModify) && !isset($formAction)):
	$formAction = '/' . $grboard . '/blog/write/post/1';
	$blogModify = array('uid'=>0,'isNotice'=>false, 'isVisible'=>true, 'isReplyable'=>true, 'isRSS'=>true, 'subject'=>'', 'content'=>'', 'tag'=>'');	
else:
	$formAction = '/' . $grboard . '/blog/modify/post/' . $ext_articleNo;
endif;
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $blogInfo['blog_title']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $skinResourcePath; ?>/skin.css" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/material.min.css" rel="stylesheet" media="screen" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/ripples.min.css" rel="stylesheet" media="screen" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/roboto.min.css" rel="stylesheet" media="screen" />
	<script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/material.min.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/ripples.min.js"></script>
	<script src="<?php echo $skinResourcePath . '/' . $ext_action; ?>.skin.js"></script>
</head>
<body>

	<div id="wrap">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/<?php echo $grboard; ?>/blog/list/page/1"><?php echo $blogInfo['blog_title']; ?></a>
				</div>
				
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/<?php echo $grboard; ?>/blog/list/page/1" title="첫 화면으로 이동 합니다">
							<span class="glyphicon glyphicon-home"></span> Home</a></li>
						</li>
						<li><a href="/<?php echo $grboard; ?>/blog/guestbook"> 
							<span class="glyphicon glyphicon-comment"></span> Guestbook</a></li>
					</ul>
				</div>
			</div>
		</nav>	
	
		<div class="container">

		<div id="blogMainContent">
			<div id="blogWrite">
				<form id="blogWriteForm" method="post" action="<?php echo $formAction; ?>" class="form-horizontal">
				<div id="blogWriteBox" class="col-sm-9">				
					
					<div id="hiddenInputs">
						<input type="hidden" name="grboard" value="<?php echo $grboard; ?>" />
						<input type="hidden" name="deleteThis" value="" />
					</div>
					
					<fieldset>
						<legend><span class="glyphicon glyphicon-edit"></span> Write a post</legend>
					
						<div class="form-group">
							<div id="blogWriteOptions" class="checkbox">
								<label><input type="checkbox" name="isNotice" value="1" <?php echo ($blogModify['isNotice']) ? 'checked="checked"' : ''; ?> /> notice</label> 
								<label><input type="checkbox" name="isVisible" value="1" <?php echo ($blogModify['isVisible']) ? 'checked="checked"' : ''; ?> /> visible</label> 
								<label><input type="checkbox" name="isReplyable" value="1" <?php echo ($blogModify['isReplyable']) ? 'checked="checked"' : ''; ?> /> reply</label> 
								<label><input type="checkbox" name="isRSS" value="1" <?php echo ($blogModify['isRSS']) ? 'checked="checked"' : ''; ?> /> rss</label>
							</div>
						</div>					
						
						<div class="form-group">	
							<div class="col-md-12">
								<input type="text" name="gr2subject" placeholder="글 제목을 입력해 주세요" required="true" autofocus="true" value="<?php echo $blogModify['subject']; ?>" class="form-control input-md" />
							</div>
						</div>		
						
						<div class="form-group">	
							<div class="col-md-12">
								<div id="gr2dndUpload" title="여기에 업로드 할 파일을 끌어다 놓으세요">
									<div id="gr2dndMsg">
										이 곳에 업로드 할 파일을 끌어다 놓으세요
									</div>
								</div>
							</div>
						</div>		
						
						<div class="form-group">		
							<div class="col-md-12">
								<textarea id="gr2content" rows="15" placeholder="글 제목을 입력해 주세요" class="form-control textarea-md"><?php echo $blogModify['content']; ?></textarea>
							</div>
						</div>	
				
					</fieldset>
						
				</div>
				
				<div id="blogWriteSidebar" class="col-sm-3">
					<div class="panel">
						<div class="panel-heading">Category</div>
						<div class="panel-body">
							<?php if(count($blogCategory)): foreach($blogCategory as &$cat): ?>
							<div class="radio">							
								<label><input type="radio" name="category" <?php echo ($blogModify['category'] == $cat['uid'])?'checked="true"':''; ?> value="<?php echo $cat['uid']; ?>" /> <?php echo stripslashes($cat['name']); ?></label>							
							</div>
							<?php endforeach; endif; ?> 
						</div>	
					</div>
					
					<div class="panel">
						<div class="panel-heading">Tag</div>
						<div class="panel-body">
							<input type="text" name="gr2tag" placeholder="글의 핵심 단어들을 콤마로 구분하여 입력해 주세요 (예: 보드,공개,수정사항,주의점,속도개선)" value="<?php echo $blogModify['tag']; ?>" class="form-control input-md" />
						</div>	
					</div>
					
					<div id="blogWriteButtons">
						<input type="submit" class="btn btn-md btn-primary wide-btn" role="button" value="Save and publish" title="글을 저장하고 공개 합니다" />
						<input id="savedraft" type="button" class="btn btn-md btn-default btn-raised wide-btn" role="button" value="Save and draft" title="글을 저장하고 공개는 하지 않습니다" />
						<?php if($blogModify['uid'] > 0): ?>
						<button id="removepost" rel="<?php echo $blogModify['uid']; ?>" class="btn btn-md btn-danger wide-btn" title="글을 삭제 합니다">Delete this post</button>
						<?php endif; ?>
					</div>
				</div>
				
				</form>
			</div>
		</div>
