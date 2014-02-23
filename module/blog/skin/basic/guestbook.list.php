<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="blogMainContent" class="col-sm-8 blog-main">
	
	<form id="blogGuestbookForm" method="post" action="/<?php echo $grboard; ?>/blog/write/guestbook" class="form-horizontal">
		<div class="hiddenInputs">
			<input type="hidden" name="reply_uid" value="" />
		</div>
		<fieldset>
			<legend><span class="glyphicon glyphicon-pencil"></span> Guestbook</legend>
			
			<?php if (!$Common->getSessionKey()): ?>
			<div class="form-group">
				<label class="col-md-3 control-label" for="simplelock"><span class="glyphicon glyphicon-asterisk"></span> Spam</label>		
				<div class="col-md-3">
					<input id="simplelock" name="simplelock" type="text" placeholder="(필수) 우측의 4자리 키 값 입력!" required="true" autofocus="true" class="form-control input-md" />
				</div>
				<span class="col-md-6 help-block"><span class="text-danger"><?php echo $simplelock; ?></span></span>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label" for="password"><span class="glyphicon glyphicon-asterisk"></span> Password</label>		
				<div class="col-md-3">
					<input id="password" name="password" type="password" placeholder="(필수) 비밀번호" required="true" class="form-control input-md" />
				</div>
				<span class="col-md-6 help-block">비밀번호를 입력해 주세요</span>
			</div>
			<?php endif; ?>
			
			<div class="form-group">
				<label class="col-md-3 control-label" for="email"> E-mail</label>		
				<div class="col-md-3">
					<input id="email" name="email" type="email" placeholder="(옵션) 이메일 주소" class="form-control input-md" />
				</div>
				<span class="col-md-6 help-block">(선택) 이메일 주소를 입력해 주세요</span>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label" for="homepage"> Homepage</label>		
				<div class="col-md-3">
					<input id="homepage" name="homepage" type="url" placeholder="(옵션) 홈페이지/블로그/트위터/페북 주소" class="form-control input-md" />
				</div>
				<span class="col-md-6 help-block">(선택) 블로그 주소를 입력해 주세요</span>
			</div>						
			
			<div class="form-group">
				<label class="col-md-3 control-label" for="name"><span class="glyphicon glyphicon-asterisk"></span> Name</label>		
				<div class="col-md-3">
					<input id="name" name="name" type="text" placeholder="(필수) 이름" required="true" class="form-control input-md" />
				</div>
				<span class="col-md-6 help-block">이름을 입력해 주세요</span>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label" for="content"><span class="glyphicon glyphicon-asterisk"></span> Comment</label>		
				<div class="col-md-9">
					<textarea id="content" name="content" rows="10" placeholder="이 곳에 댓글을 입력해 주세요" class="form-control textarea-md"></textarea>
					
					<div class="checkbox">
						<label>
							<input type="checkbox" name="secret" value="1" title="체크 하시면 비밀글로 입력 됩니다."> Secret
						</label>
					</div>
				</div>
			</div>
			
			<div class="form-group text-right">
				<input type="submit" class="btn btn-lg btn-primary" role="button" value="Submit" />
			</div>
			
		</fieldset>
		
	</form>
	
	<div id="blogPost">
		<?php foreach($guestbookList as &$guest): if(isset($guest['uid'])): ?>
		<div class="blog-post">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">							
						<?php echo strip_tags($guest['name']); ?> 
						(<?php echo date('Y-m-d', $guest['signdate']); ?>)							
						<?php if($Common->getSessionKey()): ?>
						, <a href="#" class="doReply" rel="<?php echo $guest['uid']; ?>">(reply)</a>
						<?php endif; ?>
					</h3>
				</div>
				<div class="panel-body size-text-normal">
					<?php 
					if($guest['is_secret'] && !$Common->getSessionKey()) echo '<span class="text-danger">비밀글 입니다.</span>';
					else echo nl2br(strip_tags($guest['content'])); 
					?>
					<hr />
					<div class="blogPostReply">
						
						<?php 
						$replyList = $Model->getGuestbookReplyList($guest['uid'], 20);
						if(count($replyList[0]) > 0): ?>	
						<div class="guestbookReply">							
							<?php foreach($replyList as &$reply): ?>
							<div id="message<?php echo $reply['uid']; ?>" class="well">
								<?php echo nl2br(strip_tags($reply['content'])); ?>
								<hr />
								<div class="guestReplyBy"><span>by <?php echo stripslashes($reply['name']); ?></span></div>
							</div>
							<?php endforeach; ?>
						</div>
						<?php endif; unset($reply, $replyList); ?>
						
					</div>
				</div>
			</div>				
		</div>
		<?php endif; endforeach; unset($guest, $guestbookList); ?>
	</div>
	
	<ul id="blogPage" class="pagination">		
		<li class="<?php echo ($guestbookNowBlock < 2)?'disabled':''; ?>">
			<a href="/<?php echo $grboard; ?>/blog/guestbook/page/<?php echo ($guestbookNowBlock > 1)?$ext_page-$blogInfo['num_per_page']:'1'; ?>">&laquo;</a></li>

		<?php foreach($guestbookPaging as &$pageNo): ?>
			<li class="<?php echo ($pageNo==$ext_page)?'active':''; ?>">
				<a href="/<?php echo $grboard; ?>/blog/guestbook/page/<?php echo $pageNo; ?>"><?php echo $pageNo; ?></a></li>
		<?php endforeach; unset($pageNo, $guestbookPaging); ?>

		<li class="<?php echo ($guestbookNowBlock >= $guestbookTotalBlock)?'disabled':''; ?>">
			<a href="/<?php echo $grboard; ?>/blog/guestbook/page/<?php echo ($ext_page + $blogInfo['num_per_page']); ?>">&raquo;</a></li>
	</ul>	
</div>