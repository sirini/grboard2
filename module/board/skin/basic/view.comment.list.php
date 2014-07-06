<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="replyBox">
	
	<?php 
	foreach($replyList as &$reply): 
		if($reply['is_secret'] && !$Common->getSessionKey()):
			$reply['content'] = '<span class="red">비밀글 입니다</span>';
		endif;
	?>
	<div class="gr-panel gr-panel-default" style="margin-left: <?php echo ($reply['thread'] * 40); ?>px">	
		<div class="gr-panel-heading">
			&middot; <?php if($reply['member_key'] > 0): ?><strong><?php echo $reply['name']; ?></strong>
			<?php else: echo $reply['name']; endif; ?> 
			<?php if($reply['homepage']): ?>&middot; <a href="<?php echo $reply['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">homepage</a><?php endif; ?>
			<span class="modifyTime">&middot; <?php echo date('Y.m.d H:i:s', $reply['signdate']); ?></span>
			
			<a href="#boardCommentForm" class="checkReply" rel="<?php echo $reply['no']; ?>" title="클릭 하시면 이 댓글에 대한 답글을 입력 하실 수 있습니다">&middot; reply</a>
			
			<?php if(isPermitted($reply['member_key'], $Common->getSessionKey())): ?>
				<a href="<?php echo $boardLink; ?>/deletecomment/<?php echo $reply['no']; ?>" class="remove">&middot; remove</a>
			<?php endif; ?>
		</div>

		<div id="boardReplyContent_<?php echo $reply['no']; ?>" class="gr-panel-body"><?php echo $reply['content']; ?></div>
		
	</div>
	<?php endforeach; unset($reply); ?>

</div>