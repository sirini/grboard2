<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2">

<form id="boardCommentForm" method="post" action="<?php echo $boardLink; ?>/comment/<?php echo $postUID; ?>" class="gr-form">
	<div>
		<input type="hidden" name="comment_uid" value="<?php echo $comment; ?>" />
		<input type="hidden" name="modifyProceed" value="yes" />
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Modify a comment</h3>
		</div>
		
		<ul class="list-group">
			<li class="list-group-item"><input type="checkbox" name="secret" value="1" <?php echo (($oldData['is_secret'])?'checked':''); ?> /> &middot;&middot;&middot; Secret</li>
			<li class="list-group-item"><textarea name="content" placeholder="답글 입력" class="form-control" style="height: 300px;"><?php echo $content; ?></textarea></li>
			<li class="list-group-item"><input type="submit" value="Modify" class="btn btn-primary gr-width-full" /></li>
		</ul>
	</div>
</form>
	
</div>