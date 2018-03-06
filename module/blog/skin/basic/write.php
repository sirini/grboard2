<?php 
if(!defined('GR_BOARD_2')) exit(); 
if( $Common->getSessionKey() != 1 ): 
	$Common->error($error['msg_no_permission'], '/' . $grboard . '/blog');
endif;

if(!isset($blogModify) && !isset($formAction)):
	$formAction = '/' . $grboard . '/blog/write/post/1';
	$blogModify = array('uid'=>0,'category'=>0,'isNotice'=>false, 'isVisible'=>true, 'isReplyable'=>true, 'isRSS'=>true, 'subject'=>'', 'content'=>'', 'tag'=>'');	
else:
	$formAction = '/' . $grboard . '/blog/modify/post/' . $ext_articleNo;
endif;
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title><?php echo $blogInfo['blog_title']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $skinResourcePath; ?>/skin.css" />	
	<link href="/<?php echo $grboard; ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="/<?php echo $grboard; ?>/lib/bootstrap_material_design/css/bootstrap-material-design.min.css" rel="stylesheet" media="screen" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <script src="/<?php echo $grboard; ?>/lib/jquery.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/popper.js"></script>
	<script src="/<?php echo $grboard; ?>/lib/bootstrap_material_design/js/bootstrap-material-design.min.js"></script>
	<script src="<?php echo $skinResourcePath . '/' . $ext_action; ?>.skin.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
	<a class="navbar-brand" href="/<?php echo $grboard; ?>/blog/list/page/1"><?php echo $blogInfo['blog_title']; ?></a>
		
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#grboard2TopNav" aria-controls="grboard2TopNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggle-icon"></span>
	</button>		
	
	<div id="grboard2TopNav" class="navbar-collapse collapse">
		<ul class="nav navbar-nav mr-auto">
			<li class="nav-item active">
				<a href="/<?php echo $grboard; ?>/blog/list/page/1" data-toggle="tooltip" title="사이트 첫 화면으로 이동 합니다" class="nav-link">
					Home</a></li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" role="button" id="navBlogNotice" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
				Notice</a>
				<div class="dropdown-menu" aria-labelledby="navBlogNotice">					
					<?php foreach($blogNotice as $uid => $subject): ?>
						<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/view/<?php echo $uid; ?>"><?php echo $subject; ?></a>
					<?php endforeach; ?>					
				</div>
			</li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" role="button" id="navBlogMenu" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
				Menu</a>
				<div class="dropdown-menu" aria-labelledby="navBlogMenu">
					<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/guestbook" 
						data-toggle="tooltip" data-placement="right" title="방명록에 글을 남겨 주세요! ^^">Guestbook</a>
					<?php if(!$Common->getSessionKey()): ?>
					<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/login"
						data-toggle="tooltip" data-placement="right" title="로그인을 합니다">Login</a>
					<?php else: ?>
					<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/write"
						data-toggle="tooltip" data-placement="right" title="블로그에 새로운 글을 작성 합니다">Write</a>
					<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/logout"
						data-toggle="tooltip" data-placement="right" title="로그아웃 합니다">Logout</a>
					<a class="dropdown-item" href="/<?php echo $grboard; ?>/blog/admin"
						data-toggle="tooltip" data-placement="right" title="블로그 관리 페이지로 이동 합니다">Admin</a>
					<?php endif; ?>
				</div>
			</li>				
			<li class="nav-item">
				<a href="http://sirini.net" data-toggle="tooltip" title="Powered by GR Board 2 in GRBOARD.com" class="nav-link"> 
					GR Board <sup>2</sup></a></li>
		</ul>
		
		<form id="blogSearchForm" class="form-inline my-2 my-lg-0" method="post" action="/" rel="<?php echo $grboard; ?>">
			<input id="blogSearchText" type="text" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
		</form>
		
	</div>
</nav>			

<div class="container">

	<form id="blogWriteForm" method="post" action="<?php echo $formAction; ?>" class="form-horizontal">
	<div class="row">

    		<div id="blogWriteBox" class="col-9">				
			    			
    			<div id="hiddenInputs">
    				<input type="hidden" name="grboard" value="<?php echo $grboard; ?>" />
    				<input type="hidden" name="deleteThis" value="" />
    			</div>
    			
    			<div class="card bg-light">
    				<h5 class="card-header">Write a post</h5>
    				<div class="card-body">
            			<div class="form-check form-check-inline">
            				<label class="form-check-label" for="isNotice" data-toggle="tooltip" title="이 글을 공지글로 지정 합니다">
            					<input class="form-check-input" type="checkbox" id="isNotice" name="isNotice" value="1" <?php echo ($blogModify['isNotice']) ? 'checked="true"':''; ?> /> notice
            				</label> 
            			</div>
            			
            			<div class="form-check form-check-inline">
            				<label class="form-check-label" for="isVisible" data-toggle="tooltip" title="이 글을 외부에 공개 합니다">
            					<input class="form-check-input" type="checkbox" id="isVisible" name="isVisible" value="1" <?php echo ($blogModify['isVisible']) ? 'checked="true"':''; ?> /> visible
            				</label> 
            			</div>
            			
            			<div class="form-check form-check-inline">
            				<label class="form-check-label" for="isReplyable" data-toggle="tooltip" title="이 글에 방문객들이 댓글을 달 수 있도록 지정 합니다">
            					<input class="form-check-input" type="checkbox" id="isReplyable" name="isReplyable" value="1" <?php echo ($blogModify['isReplyable']) ? 'checked="true"':''; ?> /> reply
            				</label> 
            			</div>
            			
            			<div class="form-check form-check-inline">
            				<label class="form-check-label" for="isRSS" data-toggle="tooltip" title="이 글을 RSS피드에 공개 합니다">
            					<input class="form-check-input" type="checkbox" id="isRSS" name="isRSS" value="1" <?php echo ($blogModify['isRSS']) ? 'checked="true"':''; ?> /> rss
            				</label> 
            			</div>        				
            				
                    	<div class="form-group">
                			<label for="gr2subject" class="form-control-label">Subject</label>
                			<input type="text" id="gr2subject" name="gr2subject" required="true" placeholder="글 제목을 여기에 입력해 주세요" class="form-control" value="<?php echo $blogModify['subject']; ?>" />
                    	</div>        				
            				
        				<div class="form-group">	
        					<div id="gr2dndUpload" title="여기에 업로드 할 파일을 끌어다 놓으세요">
        						<div id="gr2dndMsg">
        							이 곳에 업로드 할 파일을 끌어다 놓으세요
        						</div>
        					</div>
        				</div>		
            				
        				<div class="form-group">
        					<textarea id="gr2content" rows="15" class="form-control textarea-md"><?php echo $blogModify['content']; ?></textarea>
        				</div>	
    				</div>
    			</div>
    		</div>
    		
    		<div id="blogWriteSidebar" class="col-3">
    			<div class="card text-white bg-dark">
    				<h6 class="card-header bg-dark">Category</h6>
    				<div class="card-body">
    					<?php if(count($blogCategory)): foreach($blogCategory as &$cat): ?>
                        <div class="form-check">
                            <label class="form-check-label" for="cat<?php echo $cat['uid']; ?>">
                                <input type="radio" id="cat<?php echo $cat['uid']; ?>" name="category" <?php echo ($blogModify['category'] == $cat['uid'])?'checked="true"':''; ?> value="<?php echo $cat['uid']; ?>" /> 
                                	<?php echo stripslashes($cat['name']); ?>
                            </label>
                        </div>  
    					<?php endforeach; endif; ?> 
    				</div>	
    			</div>
    			
    			<div class="card text-white bg-dark">
    				<h6 class="card-header bg-dark">Tag</h6>
    				<div class="card-body">
    					<input type="text" name="gr2tag" data-toggle="tooltip" title="글의 핵심 단어들을 콤마로 구분하여 입력해 주세요 (예: 보드,공개,수정사항,주의점,속도개선)" value="<?php echo $blogModify['tag']; ?>" class="form-control input-md text-white" />
    				</div>	
    			</div>
    			
    			<div id="blogWriteButtons">
    				<input type="submit" class="btn btn-outline-primary btn-block" role="button" value="Save and publish" title="글을 저장하고 공개 합니다" />
    				<input id="savedraft" type="button" class="btn btn-outline-secondary btn-block" role="button" value="Save and draft" title="글을 저장하고 공개는 하지 않습니다" />
    				<?php if($blogModify['uid'] > 0): ?>
    					<button id="removepost" rel="<?php echo $blogModify['uid']; ?>" class="btn btn-md btn-outline-danger btn-block" title="글을 삭제 합니다">Delete this post</button>
    				<?php endif; ?>
    			</div>
    		</div>

    	</form>
