	<?php 
	foreach($replyList as &$reply): 
		if($reply['is_secret'] && !$Common->getSessionKey()):
			$reply['name'] = 'Hidden';
			$reply['content'] = '<span class="red">Secret comment.</span>';
		endif;
	?>
	<div class="panel panel-default" style="margin-left: <?php echo ($reply['thread'] * 20); ?>px">	
		<div class="panel-heading">
			&middot; <?php if($reply['member_key'] > 0): ?><strong><?php echo $reply['name']; ?></strong>
			<?php else: echo $reply['name']; endif; ?> 
			<?php if($reply['homepage']): ?>&middot; <a href="<?php echo $reply['homepage']; ?>" onclick="window.open(this.href, '_blank'); return false">
				<span class="glyphicon glyphicon-home"></span>
			</a><?php endif; ?>
			<span class="modifyTime">&middot; <?php echo date('m.d H:i', $reply['signdate']); ?></span>
		</div>

		<div id="boardReplyContent_<?php echo $reply['no']; ?>" class="panel-body"><?php echo $reply['content']; ?></div>
		
		<div class="panel-footer">
			<a href="#boardCommentForm" class="checkReply" rel="<?php echo $reply['no']; ?>">
				<span class="glyphicon glyphicon-pencil"></span> reply</a> &nbsp;&nbsp;			
			<?php if(isPermitted($reply['member_key'], $Common->getSessionKey())): ?>
				<a href="<?php echo $boardLink; ?>/modifycomment/<?php echo $reply['no']; ?>">
					<span class="glyphicon glyphicon-edit"></span> modify</a> &nbsp;&nbsp;
				<a href="<?php echo $boardLink; ?>/deletecomment/<?php echo $reply['no']; ?>">
					<span class="glyphicon glyphicon-trash"></span> delete</a>
			<?php endif; ?>			
		</div>
		
	</div>
	<?php endforeach; unset($reply); ?>