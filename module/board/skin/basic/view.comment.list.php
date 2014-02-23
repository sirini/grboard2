<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="replyBox">
	
	<?php 
	foreach($replyList as &$reply): 
		if($reply['is_secret'] && !$Common->getSessionKey()):
			$reply['content'] = '<span class="red">비밀글 입니다</span>';
		endif;
	?>
	<div class="replyList" style="margin-left: <?php echo ($reply['thread'] * 40); ?>px">	
		<div class="replyWriter">
			<?php if($reply['member_key'] > 0): ?><strong><?php echo $reply['name']; ?></strong>
			<?php else: echo $reply['name']; endif; ?> 
			<?php if($reply['homepage']): ?><a href="<?php echo $reply['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">(home)</a><?php endif; ?>
			<span class="modifyTime"><?php echo date('Y.m.d H:i:s', $reply['signdate']); ?></span>
			
			<a href="#boardCommentForm" class="checkReply" rel="<?php echo $reply['no']; ?>">(Reply)</a>
			
			<?php if(isPermitted($reply['member_key'], $Common->getSessionKey())): ?>
				<a href="<?php echo $boardLink; ?>/deletecomment/<?php echo $reply['no']; ?>" class="remove">(remove)</a>
			<?php endif; ?>
		</div>

		<div id="boardReplyContent_<?php echo $reply['no']; ?>" class="replyContent"><?php echo $reply['content']; ?></div>
		
	</div>
	<?php endforeach; unset($reply); ?>

</div>