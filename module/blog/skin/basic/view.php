<?php 
if(!defined('GR_BOARD_2')) exit(); 

function enableSyntaxHighlighter($text) {
	$text = str_replace('<br />', "\n", $text);
	$code = preg_replace('/\[(.+)\](.*?)\[\/(.+)\]/si', '<pre class="brush: $1">$2</pre>', $text);
	return $code;
}
?>

<div class="blog-header">
	<h1 class="blog-title"><?php echo $blogInfo['blog_title']; ?></h1>
	<p class="lead blog-description"><?php echo $blogInfo['blog_info']; ?></p>
</div>

<div id="blogMainBody" class="row">

	<div id="blogMainContent" class="col-sm-8 blog-main">
		<div id="blogPost">
			<div class="blog-post">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $blogPost['subject']; ?></h3>
					</div>
					<div class="panel-body size-text-normal overflow-hidden">
						<?php echo enableSyntaxHighlighter($blogPost['content']); ?>
						<hr />
						<div class="blogPostInfo">Tag: <?php echo $blogPost['tag']; ?>, 
							Date: <?php echo date('Y-m-d', $blogPost['signdate']); ?> 
							<span class="badge"><?php echo $blogPost['comment_count']; ?></span> Responses </div>
						<?php if($Common->getSessionKey() == 1): ?>
							<div class="blogAdmin">
								<a href="/<?php echo $grboard; ?>/blog/modify/<?php echo $blogPost['uid']?>">Modify this post</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
				
				<div id="blogReply">
				<?php if(!empty($blogReply[0]['uid'])): foreach($blogReply as &$reply): ?>
					<div class="well">
						<div id="blogContent_<?php echo $reply['uid']; ?>">
							<?php if($reply['is_reply']): ?><span class="glyphicon glyphicon-chevron-right"></span><?php endif; ?>
							<small><?php 
							if($reply['is_secret'] && $Common->getSessionKey() != 1) echo '<span class="text-danger">비밀글 입니다</span>';
							else echo nl2br(strip_tags($reply['content'])); 
							?></small>
						</div>
						<hr />
						<div class="blogReplyStatus">
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
						<fieldset>
							<legend><span class="glyphicon glyphicon-edit"></span> Leave a comment here!</legend>
							
							<?php if (!$Common->getSessionKey()): ?>
							<div class="form-group">
								<label class="col-md-3 control-label" for="simplelock">Spam</label>		
								<div class="col-md-3">
									<input id="simplelock" name="simplelock" type="text" placeholder="(필수) 우측의 4자리 키 값 입력!" required="true" class="form-control input-md" />
								</div>
								<span class="col-md-6 help-block"><span class="text-danger"><?php echo $simplelock; ?></span></span>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label" for="password">Password</label>		
								<div class="col-md-3">
									<input id="password" name="password" type="password" placeholder="(필수) 비밀번호" required="true" class="form-control input-md" />
								</div>
								<span class="col-md-6 help-block">비밀번호를 입력해 주세요</span>
							</div>
																					
							<div class="form-group">
								<label class="col-md-3 control-label" for="name">Name</label>		
								<div class="col-md-3">
									<input id="name" name="name" type="text" placeholder="(필수) 이름" required="true" class="form-control input-md" />
								</div>
								<span class="col-md-6 help-block">이름을 입력해 주세요</span>
							</div>
							
							<?php endif; ?>
							
							<div class="form-group">
								<label class="col-md-3 control-label" for="content">Comment</label>		
								<div class="col-md-9">
									<textarea id="content" name="content" required="true" rows="10" placeholder="이 곳에 댓글을 입력해 주세요" class="form-control textarea-md"></textarea>
									
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
				</div>			
					
			</div>
			<?php unset($post, $blogPost); ?>
		</div>
	</div>