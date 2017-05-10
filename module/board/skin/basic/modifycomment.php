<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2">

<h2 class="title">Modify a comment</h2>

<div>
	
	<form id="boardCommentForm" method="post" action="<?php echo $boardLink; ?>/comment/<?php echo $postUID; ?>" class="gr-form">
		<div>
			<input type="hidden" name="comment_uid" value="<?php echo $comment; ?>" />
			<input type="hidden" name="modifyProceed" value="yes" />
		</div>
		<ul class="inputs">
			<li><input type="checkbox" name="secret" value="1" <?php echo (($oldData['is_secret'])?'checked':''); ?> /> &middot;&middot;&middot; Secret</li>
			<li><textarea name="content" placeholder="답글 입력" class="gr-form-input" style="height: 300px;"><?php echo $content; ?></textarea></li>
			<li><input type="submit" value="Modify" class="gr-btn gr-btn-primary" /></li>
		</ul>
	</form>
	
</div>

</div>