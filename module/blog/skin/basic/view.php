<?php 
if(!defined('GR_BOARD_2')) exit(); 
?>

<div class="col-9">

    <div class="card">
    	<h5 class="card-header"><strong><?php echo $blogPost['subject']; ?></strong></h5>
    	<div class="card-body">
    		<p class="card-text">
        	<?php 
        	enableSyntaxHighlighter($blogPost['content']); 
        	echo $blogPost['content'];
        	?>
        	</p>
        	<hr />
        	<small>Tag: <?php echo $blogPost['tag']; ?>, 
        	Date: <?php echo date('Y-m-d', $blogPost['signdate']); ?> 
        	<?php echo $blogPost['comment_count']; ?> Responses </small>
        	
        	<?php if($Common->getSessionKey() == 1): /* for admin only */ ?>
       			<a class="card-link" href="/<?php echo $grboard; ?>/blog/modify/<?php echo $blogPost['uid']?>">Modify this post</a>
        	<?php endif; ?>
    	</div>
    </div>
    
    <div id="blogReply">
    <?php if(!empty($blogReply[0]['uid'])): foreach($blogReply as &$reply): ?>
    	<div class="panel panel-default">
    		<div class="panel-body">
    			<div id="blogContent_<?php echo $reply['uid']; ?>">
    				<?php if($reply['is_reply']): ?><span class="glyphicon glyphicon-chevron-right"></span><?php endif; ?>
    				<small><?php 
    				if($reply['is_secret'] && $Common->getSessionKey() != 1) echo '<span class="text-danger">비밀글 입니다</span>';
    				else echo nl2br(strip_tags($reply['content'])); 
    				?></small>
    			</div>
    		</div>
    		<div class="panel-footer">
    			<small>
    			<?php echo $reply['name'] ?>
    			<?php echo ($reply['homepage']) ? ' <a href="'.$reply['homepage'].'">(homepage)</a>' : ''; ?>, 
    			<?php echo date('Y-m-d H:i:s', $reply['signdate']); ?>
    			<?php echo (!$reply['is_reply']) ? ', <a href="#blogLeaveReply" class="checkReply" rel="' . $reply['uid'] . '">(reply)</a>' : ''; ?>
    			<?php echo ($Common->getSessionKey() == 1) ? ', <a href="/' . $grboard . '/blog/delete/comment/' . $reply['uid'] . '" class="red">-delete</a>' : ''; ?>
    			</small>
    		</div>
    	</div>
    <?php endforeach; endif; unset($reply); ?>
    </div>				
    
    <div id="blogLeaveReply">
    	<form id="blogCommentForm" method="post" action="/<?php echo $grboard; ?>/blog/write/comment/<?php echo $blogPost['uid']; ?>" class="form-horizontal">
    		<div class="hiddenInputs">
    			<input type="hidden" name="family_uid" value="" />
    		</div>
    		
    		<div class="card bg-light">
    			<h5 class="card-header bg-light"><strong>Leave a comment here!</strong></h5>
    			<div class="card-body">	
    			    						
    				<?php if (!$Common->getSessionKey()): ?>
            		<div class="row">
            			<div class="col">
            				<div class="form-group">
            					<label for="name">Name</label>
            					<input type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="Mr. Hong">
            					<small id="nameHelp" class="form-text text-muted">이 곳에 이름(닉네임)을 입력하세요</small>
            				</div>
            				<div class="form-group">
            					<label for="name">Password</label>
            					<input type="password" class="form-control" name="password" aria-describedby="passwordHelp" placeholder="password">
            					<small id="passwordHelp" class="form-text text-muted">이 곳에 글 수정/삭제를 위한 비밀번호를 입력하세요</small>
            				</div>
            			</div>
            			<div class="col">
            				<div class="form-group">
            					<label for="name">Email</label>
            					<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="example@website.com">
            					<small id="emailHelp" class="form-text text-muted">이 곳에 이메일 주소를 입력하세요 (선택)</small>
            				</div>
            				<div class="form-group">
            					<label for="name">Website</label>
            					<input type="url" class="form-control" name="homepage" aria-describedby="homepageHelp" placeholder="http://example.com">
            					<small id="homepageHelp" class="form-text text-muted">이 곳에 웹사이트 주소를 입력하세요 (선택)</small>
            				</div>
            			</div>
            		</div>
            
            		<!-- for Google reCAPTCHA | Please update your google reCAPTCHA sitekey/secretkey in common.config.php -->
            		<div class="form-group">			
            			<script src='<?php echo $gr2cfg['googleRecaptchaApiUrl']; ?>'></script>
            			<div class="g-recaptcha" data-sitekey="<?php echo $gr2cfg['googleRecaptchaSiteKey']; ?>"></div>
            		</div>    				
    				<?php endif; ?>
    				
            		<div class="form-group">
            			<label for="gr2CommentForm">Content</label>
            			<textarea class="form-control" id="content" rows="5" name="content"></textarea>
            		</div>
            		
            		<div class="form-group">
            			<div class="form-check">
            				<label class="form-check-label" for="secret" data-toggle="tooltip" data-placement="bottom" title="체크 하시면 비밀글로 설정 됩니다"> 
            					<input class="form-check-input" type="checkbox" name="secret" id="secret" aria-describedby="secretHelp"> check for secret
            				</label>
            			</div>
            			<input type="submit" value="SEND" class="btn btn-block btn-outline-primary" />
            		</div>    				

    				
    			</div>
    			
    		</div>
    		
    	</form>
    </div>			

</div>
		
<?php unset($post, $blogPost); ?>