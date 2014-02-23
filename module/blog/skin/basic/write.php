<?php 
if(!defined('GR_BOARD_2')) exit(); 
if( $Common->getSessionKey() != 1 ): 
	$Common->error($error['msg_no_permission'], '/' . $grboard . '/blog');
endif;

if(!isset($blogModify) && !isset($formAction)):
	$formAction = '/' . $grboard . '/blog/write/post/1';
	$blogModify = array('isNotice'=>false, 'isVisible'=>true, 'isReplyable'=>true, 'isRSS'=>true, 'subject'=>'', 'content'=>'', 'tag'=>'');	
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
	<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen" />
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
				<div id="blogWriteBox">
				
					<form id="blogWriteForm" method="post" action="<?php echo $formAction; ?>" class="form-horizontal">
					<div id="hiddenInputs">
						<input type="hidden" name="grboard" value="<?php echo $grboard; ?>" />
					</div>
					
					<fieldset>
						<legend><span class="glyphicon glyphicon-edit"></span> Write a post</legend>
					
						<div class="form-group">
							<label class="col-md-2 control-label"><span class="glyphicon glyphicon-asterisk"></span> Options</label>		
							<div class="col-md-10">
								<input type="checkbox" name="isNotice" value="1" <?php echo ($blogModify['isNotice']) ? 'checked="checked"' : ''; ?> />notice 
								<input type="checkbox" name="isVisible" value="1" <?php echo ($blogModify['isVisible']) ? 'checked="checked"' : ''; ?> />visible 
								<input type="checkbox" name="isReplyable" value="1" <?php echo ($blogModify['isReplyable']) ? 'checked="checked"' : ''; ?> />reply 
								<input type="checkbox" name="isRSS" value="1" <?php echo ($blogModify['isRSS']) ? 'checked="checked"' : ''; ?> />rss
							</div>
						</div>					
						
						<div class="form-group">
							<label class="col-md-2 control-label"><span class="glyphicon glyphicon-asterisk"></span> Subject</label>		
							<div class="col-md-10">
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
								<textarea id="gr2content" rows="15" placeholder="글 제목을 입력해 주세요" class="form-control textarea-md"><?php echo $blogModify['subject']; ?></textarea>
							</div>
						</div>	
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="gr2tag">Tags</label>		
							<div class="col-md-10">
								<input type="text" name="gr2tag" placeholder="글의 핵심 단어들을 태킹해 주세요" value="<?php echo $blogModify['tag']; ?>" class="form-control input-md" />
							</div>
						</div>	
						
						<div class="form-group text-right">
							<input type="submit" class="btn btn-lg btn-primary" role="button" value="Submit" />
						</div>
					
					</fieldset>
						
					</form>
				</div>
			</div>
		</div>
