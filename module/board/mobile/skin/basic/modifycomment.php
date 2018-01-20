<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div id="GRBOARD2">

<form id="boardCommentForm" method="post" action="<?php echo $boardLink; ?>/comment/<?php echo $postUID; ?>" class="gr-form">
	<div>
		<input type="hidden" name="comment_uid" value="<?php echo $comment; ?>" />
		<input type="hidden" name="modifyProceed" value="yes" />
	</div>
	<div class="card bg-light">
		<h4 class="card-header">Modify a comment</h4>
		<div class="card-body">
			<input type="checkbox" name="secret" value="1" <?php echo (($oldData['is_secret'])?'checked="checked"':''); ?> /> Secret
			<textarea name="content" class="form-control" style="height: 5rem;"><?php echo $content; ?></textarea>
			<div style="height:1.0rem"></div>
			<div class="row">
				<div class="col"><input type="submit" value="Modify" class="btn btn-outline-primary btn-block" /></div>
				<div class="col"><a href="<?php echo $boardLink; ?>/list/1" class="btn btn-outline-secondary btn-block">Cancel</a></div>
			</div>
				
		</div>
	</div>
</form>
	
</div>