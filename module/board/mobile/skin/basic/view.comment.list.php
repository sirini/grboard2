	<?php 
	foreach($replyList as &$reply): 
		if($reply['is_secret'] && !$Common->getSessionKey()):
			$reply['name'] = 'Hidden';
			$reply['content'] = '<span class="red">Secret comment.</span>';
		endif;
	?>
	
	<div class="card bg-light mb-3" style="margin-left: <?php echo ($reply['thread'] * 20); ?>px">	
		<div class="card-header">
			<?php if($reply['member_key'] > 0): ?><strong><?php echo $reply['name']; ?></strong>
			<?php else: echo $reply['name']; endif; ?> 
			<?php if($reply['homepage']): ?><a href="<?php echo $reply['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">
				site
			</a><?php endif; ?>
			<span class="modifyTime"><?php echo date('m.d H:i', $reply['signdate']); ?></span>
			
			<a href="#boardCommentForm" class="checkReply" rel="<?php echo $reply['no']; ?>">
				<span class="glyphicon glyphicon-pencil"></span> reply</a> &nbsp;&nbsp;			
			<?php if(isPermitted($reply['member_key'], $Common->getSessionKey())): ?>
				<a href="<?php echo $boardLink; ?>/modifycomment/<?php echo $reply['no']; ?>">
					modify</a> &nbsp;&nbsp;
				<a href="<?php echo $boardLink; ?>/deletecomment/<?php echo $reply['no']; ?>">
					delete</a>
			<?php endif; ?>					
		</div>

		<div id="boardReplyContent_<?php echo $reply['no']; ?>" class="card-body">
			<?php echo $reply['content']; ?></div>
		
	</div>
	<?php endforeach; unset($reply); ?>