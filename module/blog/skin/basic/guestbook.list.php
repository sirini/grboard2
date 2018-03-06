<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="blogMainContent" class="col-12 blog-main">	
	<form id="blogGuestbookForm" method="post" action="/<?php echo $grboard; ?>/blog/write/guestbook" class="form-horizontal">
		<div class="hiddenInputs">
			<input type="hidden" name="reply_uid" value="" />
		</div>

		<div class="card">
			<h5 class="card-header"><strong>Guestbook</strong></h5>
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
	
	<div id="blogReply">
    	<?php foreach($guestbookList as &$guest): if(isset($guest['uid'])): ?>	
    	<div class="card bg-light">
    		<div class="card-body">
    			<div id="blogContent_<?php echo $guest['uid']; ?>" <?php if($guest['is_reply']) echo 'style="padding-left: 50px"'; ?>>    				
    				<?php 
    				if($guest['is_secret'] && $Common->getSessionKey() != 1) echo '<span class="text-danger">비밀글 입니다</span>';
    				else echo nl2br(strip_tags($guest['content'])); 
    				?>
    			</div>
    		</div>
    		<div class="card-footer bg-light">
    			<div class="row">
    				<div class="col text-muted">
            			<?php echo $guest['name'] ?>
            			<?php echo ($guest['homepage']) ? ' <a href="'.$guest['homepage'].'" data-toggle="tooltip" title="댓글 작성자가 남긴 웹사이트로 이동 합니다">(homepage)</a>' : ''; ?>, 
            			<?php echo date('Y-m-d H:i:s', $guest['signdate']); ?>
    				</div>
    				<div class="col text-right">
            			<?php echo (!$guest['is_reply']) ? '<a href="#blogLeaveReply" data-toggle="tooltip" title="이 댓글에 답글을 답니다." class="checkReply btn btn-sm btn-primary" rel="' . $guest['uid'] . '">reply</a>' : ''; ?>
            			<?php echo ($Common->getSessionKey() == 1) ? '<a href="/' . $grboard . '/blog/delete/comment/' . $guest['uid'] . '" data-toggle="tooltip" title="이 글을 삭제 합니다" class="btn btn-sm btn-danger">delete</a>' : ''; ?>
    				</div>
    			</div>
    		</div>
    	</div>		
    	
    	<?php 
    	$replyList = $Model->getGuestbookReplyList($guest['uid'], 20);
    	foreach($replyList as &$reply): if(isset($reply['uid'])): 
    	?>
    	<div class="card bg-secondary text-white">
    		<div id="message<?php echo $reply['uid']; ?>" class="card-body">
    			<?php echo nl2br(strip_tags($reply['content'])); ?>
    		</div>
    		<div class="card-footer bg-secondary text-white">
    			<?php echo stripslashes($reply['name']); ?>
    		</div>			
    	</div>
    	<?php endif; endforeach; endif; endforeach; unset($reply, $replyList, $guest, $guestbookList); ?>
	</div>
</div>
