<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="replyBox">
	
	<?php 
	foreach($replyList as &$reply): 
		if($reply['is_secret'] && !$Common->getSessionKey()):
			$reply['name'] = 'Hidden';
			$reply['content'] = '<span class="red">Secret comment.</span>';
		endif;
	?>
	<div class="card bg-light mb-3" style="margin-left: <?php echo ($reply['thread'] * 40); ?>px">	
		<div class="card-header">
			<?php if($reply['member_key'] > 0): ?><strong><?php echo $reply['name']; ?></strong>
			<?php else: echo $reply['name']; endif; ?> 
			<?php if($reply['homepage']): ?>
				<a href="<?php echo $reply['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">site</a>
			<?php endif; ?>
			<span class="modifyTime"><?php echo date('Y.m.d H:i:s', $reply['signdate']); ?></span>
			
			<a href="#boardCommentForm" class="checkReply" rel="<?php echo $reply['no']; ?>" data-toggle="tooltip" title="클릭 하시면 이 댓글에 대한 답글을 입력 하실 수 있습니다">reply</a>
			
			<?php if(isPermitted($reply['member_key'], $Common->getSessionKey())): ?>
				<a href="<?php echo $boardLink; ?>/modifycomment/<?php echo $reply['no']; ?>" class="card-link" data-toggle="tooltip" title="클릭 하시면 이 댓글을 수정 합니다.">modify</a>
				<a href="<?php echo $boardLink; ?>/deletecomment/<?php echo $reply['no']; ?>" class="card-link" data-toggle="tooltip" title="클릭 하시면 이 댓글을 삭제 합니다.">remove</a>
			<?php endif; ?>
		</div>
		<div class="card-body">    
    		<div id="boardReplyContent_<?php echo $reply['no']; ?>" class="card-text">
    			<?php echo $reply['content']; ?>
    		</div>
		</div>
	</div>
	<div style="height: 0.1rem"></div>
	<?php endforeach; unset($reply); ?>

</div>